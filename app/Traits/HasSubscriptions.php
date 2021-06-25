<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    6/23/21, 4:41 PM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Traits;

use App\Models\Plan;
use App\Models\Plans\Subscription;
use App\Services\Helpers\Period;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

trait HasSubscriptions
{
    /**
     * Define a polymorphic one-to-many relationship.
     *
     * @param string $related
     * @param string $name
     * @param string $type
     * @param string $id
     * @param string $localKey
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    abstract public function morphMany($related, $name, $type = null, $id = null, $localKey = null);

    /**
     * The subscriber may have many subscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function subscriptions(): MorphMany
    {
        return $this->morphMany(Subscription::class, 'subscriber', 'subscriber_type', 'subscriber_id');
    }

    /**
     * A model may have many active subscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function activeSubscriptions(): Collection
    {
        return $this->subscriptions->reject->inactive();
    }

    /**
     * Get a subscription by slug.
     *
     * @param string $subscriptionSlug
     *
     * @return Subscription|null
     */
    public function subscription(string $subscriptionSlug): ?Subscription
    {
        return $this->subscriptions->where('slug', $subscriptionSlug)->first();
    }

    /**
     * Get subscribed plans.
     */
    public function subscribedPlans(): ?Subscription
    {
        $planIds = $this->subscriptions->reject->inactive()->pluck('plan_id')->unique();

        return $this->subscriptions->whereIn('id', $planIds)->get();
    }

    /**
     * Check if the subscriber subscribed to the given plan.
     *
     * @param int $planId
     *
     * @return bool
     */
    public function subscribedTo($planId): bool
    {
        $subscription = $this->subscriptions()->where('plan_id', $planId)->first();

        return $subscription && $subscription->active();
    }

    /**
     * Subscribe subscriber to a new plan.
     *
     * @param string $subscription
     * @param Plan $plan
     * @param Carbon|null $startDate
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function newSubscription($subscription, Plan $plan, Carbon $startDate = null)
    {
        $trial = new Period($plan->trial_interval, $plan->trial_period, $startDate ?? now());
        $period = new Period($plan->invoice_interval, $plan->invoice_period, $trial->getEndDate());

        return $this->subscriptions()->create([
            'name' => $subscription,
            'plan_id' => $plan->getKey(),
            'trial_ends_at' => $trial->getEndDate(),
            'starts_at' => $period->getStartDate(),
            'ends_at' => $period->getEndDate(),
        ]);
    }
}

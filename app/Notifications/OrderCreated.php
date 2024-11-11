<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreated extends Notification
{
    use Queueable;

    /**
     * The order instance.
     *
     * @var \App\Models\Order
     */
    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Order Created Successfully') // Optional: add a subject line
            ->line('Your order has been created successfully.')
            ->line('Order Number: ' . $this->order['order_number'])
            ->line('Product ID: ' . $this->order['product_id'])  // Pass product details
            ->line('Quantity: ' . $this->order['quantity'])     // Pass quantity
            ->line('Total Amount: ' . $this->order['amount'])    // Pass total amount
            ->line('Thank you for your purchase!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_number' => $this->order['order_number'],
            'product_id' => $this->order['product_id'],
            'quantity' => $this->order['quantity'],
            'amount' => $this->order['amount'],
        ];
    }
}
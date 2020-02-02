<?php

namespace BotMaker\Bot\Model;

class Order
{
    public const STATUS_INI = 'Created';
    public const STATUS_SENT = 'Sent';
    public const STATUS_ACCEPTED = 'Accepted';
    public const STATUS_PENDING = 'Pending';
    public const STATUS_REJECTED = 'Rejected';

    public const TYPE_BUY = 'buy';
    public const TYPE_SELL = 'sell';

    protected Pair $pair;
    protected ?string $type;
    protected float $quantity;

    /** nullable when order @ market price */
    protected ?float $price;

    protected string $status = self::STATUS_INI;
    protected ?string $message;

    public function getPair(): Pair
    {
        return $this->pair;
    }

    public function setPair(Pair $pair): Order
    {
        $this->pair = $pair;
        return $this;
    }

      public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): Order
    {
        $this->type = $type;
        return $this;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): Order
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): Order
    {
        $this->price = $price;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): Order
    {
        $this->status = $status;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): Order
    {
        $this->message = $message;
        return $this;
    }
}
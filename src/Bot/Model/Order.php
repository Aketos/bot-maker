<?php

namespace BotMaker\Bot\Model;

class Order
{
    protected Pair $pair;
    protected float $quantity;
    protected ?float $price;
}
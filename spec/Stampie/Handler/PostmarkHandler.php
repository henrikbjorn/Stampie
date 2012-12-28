<?php

namespace spec\Stampie\Handler;

use PHPSpec2\ObjectBehavior;
use Stampie\Message\Identity;

class PostmarkHandler extends ObjectBehavior
{
    /**
     * @param Stampie\Adapter\AdapterInterface $adapter
     * @param Stampie\Message\Message $message
     */
    function let($adapter, $message)
    {
        $message->getFrom()->willReturn(new Identity('henrik@bjrnskov.dk'));
        $message->getHeaders()->willReturn(array());

        $this->beConstructedWith($adapter, 'my-personal-key');
    }

    function it_calls_the_adapter_with_a_request($adapter, $message)
    {
        $adapter->call(\Mockery::type('Stampie\Adapter\Request'))->shouldBeCalled();

        $this->send(new Identity('henrik@bjrnskov.dk'), $message);
    }
}
<?php

namespace WiderFunnel\Tests\v1;

use WiderFunnel\Tests\TestCase;

/**
 * Class VariationsTest
 */
class VariationsTest extends TestCase
{
    /** @test */
    public function it_can_fetch_the_list_of_variations_in_an_experiment()
    {
        $client = $this->fakeClient('variations/variations');

        $optimizely = new \WiderFunnel\Optimizely($client);
        $variations = $optimizely->experiments()->variations('1');

        $this->assertInstanceOf(\WiderFunnel\Collections\VariationCollection::class, $variations);
        $this->assertObjectHasAttribute('items', $variations);
        $this->assertInstanceOf(\WiderFunnel\Items\Variation::class, $variations->first());
        $this->assertObjectHasAttribute('id', $variations->first());
        $this->assertJsonStringEqualsJsonFile($this->getStub('variations/variations'), $variations->toJson());
    }

    /** @test */
    public function it_can_fetch_a_variation()
    {
        $client = $this->fakeClient('variations/variation');

        $optimizely = new \WiderFunnel\Optimizely($client);
        $variation = $optimizely->variations()->find('1');

        $this->assertInstanceOf(\WiderFunnel\Items\Variation::class, $variation);
        $this->assertJsonStringEqualsJsonFile($this->getStub('variations/variation'), $variation->toJson());
    }

    /** @test */
    public function it_can_create_a_variation_in_an_experiment()
    {
        $client = $this->fakeClient('variations/variation');

        $optimizely = new \WiderFunnel\Optimizely($client);
        $variation = $optimizely->experiment('1')->createVariation('Variation #2', [
            'start_time' => '2015-01-01T08:00:00Z'
        ]);

        $this->assertInstanceOf(\WiderFunnel\Items\Variation::class, $variation);
        $this->assertJsonStringEqualsJsonFile($this->getStub('variations/variation'), $variation->toJson());
    }

    /** @test */
    public function it_can_update_a_variation()
    {
        $client = $this->fakeClient('variations/variation');

        $optimizely = new \WiderFunnel\Optimizely($client);
        $variation = $optimizely->variation('1')->update(['start_time' => '2015-01-01T08:00:00Z']);

        $this->assertInstanceOf(\WiderFunnel\Items\Variation::class, $variation);
        $this->assertJsonStringEqualsJsonFile($this->getStub('variations/variation'), $variation->toJson());
    }

    /** @test */
    public function it_can_delete_a_variation()
    {
        $client = $this->fakeClient('variations/variation');

        $optimizely = new \WiderFunnel\Optimizely($client);
        $variation = $optimizely->variations()->delete('1');

        $this->assertTrue($variation);
    }
}
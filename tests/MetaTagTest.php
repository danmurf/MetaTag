<?php

use danmurf\MetaTag as MetaTag;

class MetaTagTest extends TestCase {

    /**
     * @test
     */
    public function testing_setup_works_ok() {
        $this->assertTrue(true);
    }

    /**
     * @test
     */
     public function can_set_keywords()
     {
         $metatag = new MetaTag();
         $this->assertNull($metatag->keywords(['first', 'second', 'third']));
     }
}

<?php

namespace T2N\endiorite\effect;

use pocketmine\entity\effect\EffectInstance;

class HangGliderEffect extends EffectInstance {

    protected int $amplifier;

    public function getAmplifier(): int {
        return $this->amplifier;
    }

    public function setAmplifier(int $amplifier): EffectInstance {
        $this->amplifier = $amplifier;
        return $this;
    }

}
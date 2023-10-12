<?php
class Character {
    protected string $name;
    protected int $power;
    protected int $health;

    public function __construct($name, $power, $health) {
        $this->name = $name;
        $this->power = $power;
        $this->health = $health;
    }

    public function attack($target, $critical = false): void
    {
        $damage = $this->power;
        if ($critical) {
            $damage *= 5; // Change this for different crit for dmg
        }
        $target->health -= $damage;

        if ($target->health < 0) {
            $target->health = 0;
        }
    }

    public function getName(): string {
        return $this->name;
    }

    public function getHealth(): int {
        return $this->health;
    }
}

class Hero extends Character {
//    IDK what to do next, kinda confusin
//    protected int $level;
//    protected int $experience;
//
//    public function __construct($level, $experience) {
//        $this->level = $level;
//        $this->experience = $experience;
//    }
//
//    public function getLvl(): int {
//        return $this->level;
//    }
//    public function getExp(): int {
//        return $this->experience;
//    }
}

class Villain extends Character {
// ?????????????????????????????????
}

$hero = new Hero('Strong Knight', 45, 500);
$villain = new Villain('Cave Monster', 35, 700);

$round = 1;
while ($hero->getHealth() > 0 && $villain->getHealth() > 0) {
    echo "Round $round" . PHP_EOL;

    // Critical hit for hero
    $heroCriticalHit = mt_rand(1, 6) > 4;

    // Hero attacks villain
    $hero->attack($villain, $heroCriticalHit);
    echo "{$hero->getName()} attacked {$villain->getName()}. {$villain->getName()}'s health: {$villain->getHealth()}";
    if ($heroCriticalHit) {
        echo " (Critical Hit)" . PHP_EOL;
    }
    echo PHP_EOL;

    // Critical hit for villain
    $villainCriticalHit = mt_rand(1, 6) > 4;

    // Villain attacks hero
    $villain->attack($hero, $villainCriticalHit);
    echo "{$villain->getName()} attacked {$hero->getName()}. {$hero->getName()}'s health: {$hero->getHealth()}";
    if ($villainCriticalHit) {
        echo " (Critical Hit)" . PHP_EOL;
    }
    echo PHP_EOL;

    $round++;
}

if ($hero->getHealth() <= 0) {
    echo "{$villain->getName()} wins!" . PHP_EOL;
} else {
    echo "{$hero->getName()} wins!" . PHP_EOL;
}

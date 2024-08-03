<?php

namespace App\DataFixtures;

use App\Entity\Seo;
use App\Entity\Page;
use App\Entity\OGTags;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        

        for ($i = 1; $i < 20; $i++) {

            $page = new Page();
            $seo = new Seo();
            $ogTags = new OGTags();

            $page->setTitle("Test " . (string) $i);
            $page->setUrl("test-" . (string) $i);
            $page->setShortBody('Short body');
            $page->setBody('Long text');
            $seo->setTitle('Seo title' . (string) $i);
            $seo->setHideInSitemap(true);
            $seo->setAuthor('localhost');
            $seo->setRobots('noidex, nofollow');
            $seo->setKeywords('symfony, locahost, development php');
            $seo->setDescription('Seo description for page ' . (string) $i);
            $page->setSeo($seo);
            $ogTags->setTitle('OG - title ' . (string) $i);
            $ogTags->setType('article');
            $ogTags->setLocale('cs_CZ');
            $ogTags->setSiteName('localhost');
            $page->setOgTags($ogTags);
            $page->setIsPublished(true);

            $manager->persist($seo);
            $manager->persist($ogTags);
            $manager->persist($page);
            $manager->flush();
        }
    }
}

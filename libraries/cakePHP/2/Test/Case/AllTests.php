<?php class AllControllerTest extends CakeTestSuite
{
    public static function suite()
    {
        $suite = new CakeTestSuite('All tests');
        $suite->addTestDirectory(TESTS . 'Case/Controller/Component');
        //$suite->addTestDirectory(TESTS . 'Case/Controller');
        $suite->addTestDirectory(TESTS . 'Case/Model');

        //as a cron job.
        $suite->addTestDirectory(TESTS . 'Case/Listener');

        return $suite;
    }
}
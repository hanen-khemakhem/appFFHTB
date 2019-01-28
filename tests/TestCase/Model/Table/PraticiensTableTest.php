<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PraticiensTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PraticiensTable Test Case
 */
class PraticiensTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PraticiensTable
     */
    public $Praticiens;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.praticiens'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Praticiens') ? [] : ['className' => PraticiensTable::class];
        $this->Praticiens = TableRegistry::getTableLocator()->get('Praticiens', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Praticiens);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

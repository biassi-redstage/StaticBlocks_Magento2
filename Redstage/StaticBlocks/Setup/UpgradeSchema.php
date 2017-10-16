<?php

namespace Redstage\StaticBlocks\Setup;

use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
 
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @var \Magento\Cms\Model\BlockFactory
     */
    private $blockFactory;

    public function __construct(BlockFactory $blockFactory)
    {
        $this->blockFactory = $blockFactory;
    }
    
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
 
        if (version_compare($context->getVersion(), '1.0.1') < 0) {
            $cmsBlockData = [
                'title' => 'Msg - My block 2',
                'identifier' => 'my_custom_block_two',
                'content' => "<p class=\"my-block\">Message to my block 2</p>",
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0
            ];

            $this->blockFactory->create()->setData($cmsBlockData)->save();
        }

        //if (version_compare($context->getVersion(), '1.0.2') < 0) {
            //code to upgrade to 1.0.2
        //}
 
        $setup->endSetup();
    }
}
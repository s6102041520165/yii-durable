<?php

use yii\db\Migration;

/**
 * Class m191029_021553_init_rbac
 */
class m191029_021553_init_rbac extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "createOrders" permission
        $createOrders = $auth->createPermission('createOrders');
        $createOrders->description = 'Create a order.';
        $auth->add($createOrders);

        // add "updateOrders" permission
        $updateOrders = $auth->createPermission('updateOrders');
        $updateOrders->description = 'Update orders.';
        $auth->add($updateOrders);
        
        $user = $auth->createPermission('manageUser');
        $user->description = 'Mange User';
        $auth->add($user);
        
        $material = $auth->createPermission('manageMaterial');
        $material->description = 'Mange Material';
        $auth->add($material);
        
        $teachManage = $auth->createPermission('manageTeacher');
        $teachManage->description = 'Mange Teacher';
        $auth->add($teachManage);
        
        $brand = $auth->createPermission('manageBrand');
        $brand->description = 'Mange Brands';
        $auth->add($brand);
        
        $type = $auth->createPermission('manageType');
        $type->description = 'Mange Types';
        $auth->add($type);
        
        $unit = $auth->createPermission('manageUnit');
        $unit->description = 'Mange Units';
        $auth->add($unit);
        
        $faculty = $auth->createPermission('manageFaculty');
        $faculty->description = 'Mange Faculties';
        $auth->add($faculty);
        
        $prefix = $auth->createPermission('managePrefix');
        $prefix->description = 'Mange Prefixs';
        $auth->add($prefix);

        // add "teacher" role and give this role the "createOrders" permission
        $teacher = $auth->createRole('teacher');
        $auth->add($teacher);
        $auth->addChild($teacher, $createOrders);

        // add "admin" role and give this role the "updateOrders" permission
        // as well as the permissions of the "teacher" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateOrders);
        $auth->addChild($admin, $user);
        $auth->addChild($admin, $material);
        $auth->addChild($admin, $teachManage);
        $auth->addChild($admin, $brand);
        $auth->addChild($admin, $type);
        $auth->addChild($admin, $unit);
        $auth->addChild($admin, $faculty);
        $auth->addChild($admin, $prefix);
        
        //เพิ่มสิทธิให้ Admin สามารถจัดการข้อมูลทุกอย่างที่ teacher ทำได้
        //$auth->addChild($admin, $teacher);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($admin, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191029_021553_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}

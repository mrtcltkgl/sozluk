<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\rbac\AuthorRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // Başlık Ekleme İzni
        $createTitle = $auth->createPermission('createTitle');
        $createTitle->description = 'Başlık Oluşturmak İçin';
        $auth->add($createTitle);
		
		//// Başlık silme
		$deleteTitle = $auth->createPermission('deleteTitle');
        $deleteTitle->description = 'Başlık Silmek İçin';
        $auth->add($deleteTitle);

        // Başlık güncelleme
        $updateTitle = $auth->createPermission('updateTitle');
        $updateTitle->description = 'Başlık güncellemek İçin';
        $auth->add($updateTitle);
		
//---------------------------------------------------------------------------------------------------------------
        // Etiket Ekleme İzni
        $createTag = $auth->createPermission('createTag');
        $createTag->description = 'Etiket Oluşturmak İçin';
        $auth->add($createTag);
		
		//// Etiket silme
		$deleteTag = $auth->createPermission('deleteTag');
        $deleteTag->description = 'Etiket Silmek İçin';
        $auth->add($deleteTag);

        // Etiket güncelleme
        $updateTag = $auth->createPermission('updateTag');
        $updateTag->description = 'Etiket güncellemek İçin';
        $auth->add($updateTag);

//---------------------------------------------------------------------------------------------------------------

        // Mesaj Ekleme İzni
        $createMessage = $auth->createPermission('createMessage');
        $createMessage->description = 'Mesaj Oluşturmak İçin';
        $auth->add($createMessage);
		
		//// Mesaj silme
		$deleteMessage = $auth->createPermission('deleteMessage');
        $deleteMessage->description = 'Mesaj Silmek İçin';
        $auth->add($deleteMessage);

        // Mesaj güncelleme
        $updateMessage = $auth->createPermission('updateMessage');
        $updateMessage->description = 'Mesaj güncellemek İçin';
        $auth->add($updateMessage);

//----------------------------------------------------------------------------------------------------------------		
		
		// add "author" role and give this role the "createPost" permission
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createMessage);//mesaj oluşturur
		$auth->addChild($author, $createTitle);//başlık oluşturur.
		
		
		//moderator yetkileri
		$moderator =$auth->createRole('moderator');
		$auth->add($moderator);
		$auth->addChild($moderator,$updateTitle);
		$auth->addChild($moderator,$deleteTitle);
		$auth->addChild($moderator,$updateMessage);
		$auth->addChild($moderator,$deleteMessage);
		$auth->addChild($moderator,$author);
		

        // admin yetkileri
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $createTag);
		$auth->addChild($admin, $updateTag);
		$auth->addChild($admin, $deleteTag);		
		$auth->addChild($admin, $moderator);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
		$auth->assign($author, 3);
		$auth->assign($moderator,2);
        $auth->assign($admin, 1);
    }
 
 public function actionAuthorRule()
 {
  $auth = Yii::$app->authManager;

  // add the rule
  $rule = new AuthorRule;
  $auth->add($rule);

  // add the "updateOwnPost" permission and associate the rule with it.
  $updateOwnMessage = $auth->createPermission('updateOwnMessage');
  $updateOwnMessage->description = 'Kendi Mesajını Güncelle';
  $updateOwnMessage->ruleName = $rule->name;
  $auth->add($updateOwnMessage);

  // "updateOwnPost" will be used from "updatePost"
  $updateMessage = $auth->getPermission('updateMessage');
  $auth->addChild($updateOwnMessage, $updateMessage);
  
  // add the "updateOwnPost" permission and associate the rule with it.
  $deleteOwnMessage = $auth->createPermission('deleteOwnMessage');
  $deleteOwnMessage->description = 'Kendi Mesajını Sil!!';
  $deleteOwnMessage->ruleName = $rule->name;
  $auth->add($deleteOwnMessage);

  // "updateOwnPost" will be used from "updatePost"
  $deleteMessage = $auth->getPermission('deleteMessage');
  $auth->addChild($deleteOwnMessage, $deleteMessage);

  

  // allow "author" to update their own posts
  $author = $auth->getRole('author');
  $auth->addChild($author, $updateOwnMessage);
  $auth->addChild($author, $deleteOwnMessage);
  

 }
}
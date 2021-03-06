<?php
ob_start();
include_once '../src/utils/autoloader.php';

use Save\SaveRepository;

$db = (new DbAdaperFactory())->createService();
$saveRepo = new SaveRepository($db);

if (isset($_POST['deleteSave'])) {
    $saveRepo->deleteSave(intval($_POST['saveId']));
    $_SESSION['success'] = "Votre sauvegarde a été effacée !";
    header('Location: saved_stories.php');
}

if (isset($_POST['save'])) {
    if (isset($_SESSION['id'])) {
        $saveId = $saveRepo->existSave($_SESSION['id'], $_POST['storyId']);
        if ($saveId) {
            $saveRepo->updateSave($saveId, $_POST['pageId'], $_SESSION['skill'], $_SESSION['stamina'], $_SESSION['luck']);
        } else {
            $saveRepo->addSave($_SESSION['id'], $_POST['pageId'], $_SESSION['skill'], $_SESSION['stamina'], $_SESSION['luck']);
        }
        $_SESSION['success'] = "Votre partie a été sauvegardée avec succès !";
        header("Location: story.php?storyId=".$_POST['storyId']."&pageId=".$_POST['pageId']."");
    }
    else{
        $_SESSION['errors'] = "Vous devez être connecté pour sauvegarder. Une fois connecté, cliquez sur \"Reprendre\" pour continuer";
        header("Location: login.php");
    }
}
?>
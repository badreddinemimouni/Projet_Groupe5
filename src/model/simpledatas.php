<?php
include_once(__DIR__ . '/../include/tableau.php');

function create($datas)
{
    ecrireFile('datas.json', $datas);
}

function delete($cle, &$tab, $name)
{
    unset($tab[$cle]);
    ecrireFile($name, $tab);
}

function getOne($cle)
{
    $datas = getAll();
    if (array_key_exists($cle, $datas)) {
        return $datas[$cle];
    }
    return false;
}

function getAll()
{
    $datas = lireFile('datas.json');
    return $datas;
}

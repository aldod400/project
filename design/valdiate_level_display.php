<?php


function val_migrate($minlevel, $whereto)
{

    if (isset($_SESSION['level'])) {
        switch ($_SESSION['level']) {
            case $minlevel>$_SESSION['level']:
                header("Location: $whereto");
                break;
            default:
                break;
        }

    }
}

function val_hide($level)
{
    if (isset($_SESSION['level'])) {
    switch ($_SESSION['level']) {
        case $level != $_SESSION['level']:
            echo "style = \"display:none\" ";
            break;
        default:
            break;
    }

}
}
?>
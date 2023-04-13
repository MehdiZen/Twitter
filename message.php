<?php

require_once('header.php');
$host = 'www.webacademie-project.tech';
$dbname = 'twitter_academy_db';
$username = 'wac209_user';
$password = 'wac209';

?>

<div class="col-4">

    <div class="" id="sticky">

        <p class="fw-bold">Messages</p>

        <div class="trending mt-4">
            <input type="text" class="" placeholder="Recherche DeadBird"></input>
        </div>

    </div>

    <div class="container-fluid">

        <div class="mid3">

            <!-- <div class="container-fluid"> -->

                <a href="" class="champmessage">

                    <div class="champmessage p-2">

                        <div class="row">

                            <div class="col-3 text-center">

                                <img class="rounded-circle bg-light mt-1" src=<?= $value['avatar'] ?> alt="" width="50px" height="50px">

                            </div>

                            <div class="col-9 text-center">

                                <div class="d-flex">

                                    <p class="pseudo fw-bold">Jean-Mi</p>
                                    <p class="arobase indice">@JMdu16</p>

                                    <p class="temporis indice mx-3">25 min</p>

                                </div>

                                <div class="text-center">

                                </div>

                                <p id="text"> Hello </p>


                            </div>

                        </div>

                    </div>

                </a>

                <a href="" class="champmessage">
                
                    <div class="champmessage p-2">

                        <div class="row">

                            <div class="col-3 text-center">

                                <img class="rounded-circle bg-light mt-1" src=<?= $value['avatar'] ?> alt="" width="50px" height="50px">

                            </div>

                            <div class="col-9 text-center">

                                <div class="d-flex">

                                    <p class="pseudo fw-bold">Miriame</p>
                                    <p class="arobase indice">@RastaLaDelincante</p>

                                    <p class="temporis indice mx-3">1h</p>

                                </div>

                                <div class="text-center">

                                </div>

                                <p id="text"> Sal merde </p>


                            </div>

                        </div>

                    </div>

                </a>

                <a href="" class="champmessage">

                    <div class="champmessage p-2">

                        <div class="row">

                            <div class="col-3 text-center">

                                <img class="rounded-circle bg-light mt-1" src=<?= $value['avatar'] ?> alt="" width="50px" height="50px">

                            </div>

                            <div class="col-9 text-center">

                                <div class="d-flex">

                                    <p class="pseudo fw-bold">JC</p>
                                    <p class="arobase indice">@JCtheGoat</p>

                                    <p class="temporis indice mx-3">2 h</p>

                                </div>

                                <div class="text-center">

                                </div>

                                <p id="text"> jsuis pas jesus </p>


                            </div>

                        </div>

                    </div>

                </a>

            <!-- </div> -->

        </div>

    </div>

</div>

<div class="col-4 d-flex justify-content-center">

    <div class="container mx-auto d-block right-message">

        <div class="center text-white">

            <h3 class="fw-bold">Sélectionnez un messages.</h5>

            <p class="">Faites un choix dans vos conversations existantes , commencez en une nouvelle ou ne changez rien.</p>

            <div class="">

                <div class="button-message" data-bs-toggle="modal" data-bs-target="#myModalIns">

                    <button class="">Nouveau message</button>

                </div>

            </div>

        </div>

    </div>

</div>
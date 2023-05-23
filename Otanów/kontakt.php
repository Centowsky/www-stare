<?php
    
                        if (isset($_POST['wyslij'])) {
    
                            $msg = '';
                            function writeError($msg) {
                                echo "<div class='row'>";
                                echo "<div class='col-md-4 col-centered' style='margin-top: 2%;'>";
                                echo "<p class='error'>";
                                echo $msg;
                                echo "</p>";
                                echo "</div>";
                                echo "</div>";
                            }
    
                            $telefon = $_POST['telefon'];
    
                            $email = $_POST['email'];
                            
                            $kategoria = $_POST['kategoria'];
    
                            $tresc = $_POST['tresc'];
    
                            $data = date('d-m-Y');
    
                            $godzina = date('H:i:s');
    
                            $dokogo = "ospotanow@gmail.com";
    
                            $tytul = $kategoria." | OSP-OTANÓW";
    
                            $msg .= "------------------------------------------------" . "\n";
                            $msg .= "|       Formularz kontaktowy     |" . "\n";
                            $msg .= "------------------------------------------------" . "\n\n";
                            $msg .= "Numer " . $telefon . " skontaktował/a się z tobą." . "\n";
                            $msg .= "Adres email do odpowiedzi: " . $email . "\n\n";
                            $msg .= "------------------------------------------------" . "\n\n";
                            $msg .= $tresc . "\n\n";
                            $msg .= "------------------------------------------------" . "\n\n";
                            $msg .= $data . "\n";
                            $msg .= $godzina;
    
                            $sukces = mail($dokogo, $tytul, $msg);
    
                            if ($sukces){
                                echo "<script>";
                                echo "location.href='/..'";
                                echo "</script>";
                            }
                            else{
                                $msg = "Cos poszlo nie tak!";
                                writeError($msg);
                            }
    
                        }
    
                        ?>
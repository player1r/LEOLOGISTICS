<?

?>

<form method="POST" action="<? echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            

                                <p>ФИО <span class="error" style="color:red;">* <?php echo $nameErr;?></span></p>
                                <input type="text" name="name" value="<?php echo $name;?>">

                                <p>Эл.почта <span class="error" style="color:red;">* <?php echo $emailErr;?></span></p>
                                <input type="text" name="email" value="<?php echo $email;?>">

                                <p>Страна</p>
                                <input type="text" name="country" value="<?php echo $country;?>">
                                
                                <p>Город</p>
                                <input type="text" name="city" value="<?php echo $city;?>">

                                <p>Организация <span class="error" style="color:red;">* <?php echo $jobErr;?></span></p>
                                <input type="text" name="job" value="<?php echo $job;?>">

                                <p>Учёная степень</p>
                                <select name="stepen" value="<?php echo $stepen;?>">
                                <option value="" disabled selected hidden></option>
                                <?php while($mas = mysqli_fetch_array($res))
                                {?>
                                    <option><?echo $mas['stepen'];?></option>
                                <?}?>
                                </select></br>
                                
                                <p>Учёное звание</p>
                                <select name="zvanie" value="<?php echo $zvanie;?>">
                                <option value="" disabled selected hidden></option>
                                <?php while($mas = mysqli_fetch_array($res1))
                                {?>
                                    <option><?echo $mas['zvanie'];?></option>
                                <?}?>
                                </select></br>
                                
                                <p>Секция <span class="error" style="color:red;">* <?php echo $sectionErr;?></span></p>
                                <select name="section" value="<?php echo $section;?>">
                                <option value="" disabled selected hidden></option>
                                <?php while($mas = mysqli_fetch_array($sections))
                                {?>
                                    <option><?echo $mas['name'];?></option>
                                <?}?>
                                </select></br>
                                
                                
                                <div class="g-recaptcha" data-sitekey="6LcVb6MZAAAAAMhQKCJL876Ya_m7Sp6gVxOHgV9c"></div>

                                <button type="submit" name="id_conf" value="<?=$id_conf;?>">Подать заявку</button>
                            </form>
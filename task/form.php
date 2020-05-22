<?php 
	include_once('../functions/fun.php');
?>

<style>
        body {
            background-image: -webkit-gradient(linear, right top, left bottom, from(#F2E3C6), to(#A7A1A5));
            background-image: linear-gradient(to left bottom, #F2E3C6 0%, #A7A1A5 100%);
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">

    <div class=" container " style="margin: 0 10%; margin-top: 50px;background-color: white; ">
      <form action='' method='post' enctype='multipart/form-data'>
            <div  class="text-center " style="background-color:#1ec4da; height: 100px; "> 
                <h2 class="title is-size-2 " style="padding-top: 25px; color: white; text-align: center; "><b>Заявка</h2>
            </div>
            <h3 class="title is-size-4 " style="padding-top: 25px; color: black; text-align: center; color: black;"><b>Перейти в чат</h3>
                <h4 class="title is-size-5 " style="margin-top: -20px; color: black; text-align: center; color: #9a9a9a; "><b>с сотрудником службы поддержки</h4>

                <div class="columns is-gapless is-multiline is-mobile " style="margin: 0 20%; padding-top: 5vh; ">
                
                    <div class="column is-narrow ">
                        <label class="label " style="margin-top: 5px; font-weight: normal ; color: black;">Заголовок:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                    <div class="column is-auto ">
                       <input required class="input id" name='title' type='text' name='title' type="text" placeholder="Заголовок">
                    </div>
                </div>
                
                <div class="columns is-gapless is-multiline is-mobile " style="margin: 0 20%; padding-top: 5vh; ">

                    <div class="column is-narrow ">
                        <label class="label " style=" font-weight: normal ; color: black;">Тема обращения:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                    
                
                    <div class="column is-auto ">
                        <div class="select is-fullwidth ">
                            <?php reason_selector(); ?>
                        </div>                                               

                
                    </div>
                </div>
                <div class="columns is-gapless is-multiline is-mobile " style="margin: 0 20%; padding-top: 5vh; ">
                    <div class="column is-narrow ">
                        <label class="label " style="margin-bottom: 0.5vh; font-weight: normal ; ">Суть обращения:&nbsp;</label>
                     </div>
                     <div class="column is-narrow ">
                     </div>
                     <div class="column is-auto ">
                     </div>
                     <div class="column is-auto ">
                    </div>
                    <div class="column is-auto ">
                    </div>
                    <div class="column is-auto ">
                    </div>
                     <div class="column is-auto ">
                        <label class="label " style=" font-weight: normal ; color: royalblue; "><input name='userfile' type='file'></label>
                     </div>

        </div>
       
        <div class="field-body " style="margin-bottom: 2vh ; margin: 0 20%; ">
            <div class="field ">
                <div class="control ">
                    <textarea  name='data' class="textarea " placeholder="Расскажите о Вашей проблеме "></textarea>
                </div>
            </div>
        </div>
        
        <div class="columns is-mobile is-centered " style=" padding-top: 3hv;margin: 0 45%; ">
          
            <div class="column ">
                <button class="button "  style="background-color: #25c7d9; border-radius: 5px;color: white; font-weight: normal ; ">Отправить</button>
            </div>
           
            </form>

        </div>
        </div>
	


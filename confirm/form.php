		<style>
        body {
            background-image: -webkit-gradient(linear, right top, left bottom, from(#F2E3C6), to(#A7A1A5));
            background-image: linear-gradient(to left bottom, #F2E3C6 0%, #A7A1A5 100%);
        }
    </style>
		<form action='' method='post'>
    <div class=" container " style="margin: 0 10%; margin-top: 50px;background-color: white; ">
      
            <div  class="text-center " style="background-color:#1ec4da; height: 100px; "> 
            </div>
            
            <div class="container is-bordered " style="padding:3% 20% 10%; ">
                <form>
                    <h1 class="title " style="text-align: center; "> Регистрация </h1>
                    <div class="field ">
                        <label class="label ">Имя<re>*</re></label>
                        <div class="control ">
                            <input class="input" name='name' type='text' required  placeholder="Имя">
                        </div>
                    </div>
                    <div class="field ">
                        <label class="label ">Фамилия<re>*</re></label>
                        <div class="control ">
                            <<input  class="input"name='surname' type='text' required placeholder="Фамилия">
                        </div>
                    </div>
                    <div class="field ">
                        <label class="label ">Отчетсво<re>*</re></label>
                        <div class="control ">
                            <input class="input "class="input" name='patronymic' type='text' required>
                        </div>
                    </div>
                    <div class="field ">
                        <label class="label ">Телефон<re>*</re></label>
                        <div class="control ">
                            <input class="input" name='phone' type='tel' required>
                        </div>
                    </div>
                    <div class="field " style="padding-top: 10px; ">
                        <label class="label ">Email<re>*</re></label>
                        <div class="control ">
                            <input class="input" type="email" required placeholder="Email" id='email' name='email' disabled value='<?php echo $e[0];?>'>
                        </div>
                    </div>
                    <div class="field ">
                        <label class="label ">Пароль<re>*</re></label>
                        <div class="control ">
                            <input class="input" required type="password" placeholder="Password" id='password' name='password'>
                        </div>
                    </div>
                    <div class="field ">
                        <label class="label ">Повторите пароль<re>*</re></label>
                        <div class="control ">
                            <input class="input " type="password " placeholder="пароль ">
                        </div>
                    </div>
                    <div class="field " style="text-align: center ; ">
                        <p class="control ">
                            <button class="button is-success is-fullwidth " style="background-color: #25c7d9; ">
                        Зарегистрироваться
                    </button>
                        </p>
                        <a href='#'>Войти</a>
                    </div>
                </form>
            </div>
        </did>

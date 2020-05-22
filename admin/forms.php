	<form action='' method='post'>
	<div class="modal" id="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
          <header class="modal-card-head">
            <p class="modal-card-title">Добавление сотрудника</p>
            <button class="delete" id="delete" aria-label="close"></button>
          </header>
          <section class="modal-card-body">
            <div class="field">
                <label class="label">E-mail</label>
                <div class="control">
					<input class="input" type='email' name='email_add'>
                </div>
              </div>
            <div class="field">
                <label class="label">Роль</label>
              <div class="select">
                <select name='value'>
					  <option value='1'>Пользователь</option>
					  <option value='2'>Сотрудник поддержки</option>
					  <option value='3'>Администратор</option>
					</select>
              </div>
            </div>
          </section>
          <footer class="modal-card-foot">
            <button class="btn btn-primary btn-flat" id="submit">Отправить</button>
          </footer>
        </div>
      </div>



    <div class="hero" style="background-color: #26c6da; margin-left: 20%;margin-right: 20%;">
        <div class="hero-body">
            <h1 class="title" style="text-align: center;color: white;">Выбор сотрудника</h1>
        </div>
    </div>
    <div style="background-color: white; margin-left: 20%; margin-right: 20%;">
    <div style="background-color: white;margin-left: 20%;margin-right: 20%;">&nbsp;</div>
    <div class="infinite-list" id="container">
    </div></div>
    <div class="columns" style="background-color: white;margin-left: 20%;margin-right: 20%;">
        <div class="column is-5"></div>
        <div class="column is-2">
          
            <div class="btn btn-primary btn-flat" id="gg" style="margin-top:10px">
                Добавить сотрудника
            </div>
        </div>  
        <div class="column is-5"></div>  
    </div>
<script src="load-users.js"></script>
<script>
    document.getElementById("gg").onclick = () => {
    document.getElementById('modal').classList.add("is-active");
    }
    document.getElementById("delete").onclick = () => {
        document.getElementById("modal").classList.remove("is-active");
    }
</script>
</form> 

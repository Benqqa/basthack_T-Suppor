let currentChatId = window.location.href.slice(window.location.href.length-1, window.location.href.length);
//if (currentChatId[0] == "0") currentChatId = currentChatId.slice(currentChatId.length-2,currentChatId.length);

fetch('https://besthack.newpage.xyz/ajax_api/full_user_info.php?id='+currentChatId)
    .then(res => res.json())
    .then(user => {
        document.getElementById('name').value = user.name;
        document.getElementById('surname').value = user.surname;
        document.getElementById('patron').value = user.patronymic;
        document.getElementById('phone').value = user.phone;
        document.getElementById('soc').value = 'vk.com/' + user["vk_id"];
        document.getElementById('photo').src = 'https://besthack.newpage.xyz/img/user_icon/' + user.image;
    })
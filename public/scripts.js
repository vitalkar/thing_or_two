

const app = (function() {
    
    let form, shortenButton, urlListDisplay;

    function init() {
        console.log('init app');
        form = document.forms[0];
        // console.log(form);
        urlListDisplay = document.querySelector('.url_list');

        shortenButton = document.querySelector('.shorten_button');
        shortenButton.addEventListener('click', handleSubmit);
        //load URL list
        loadList();

        console.log(window.location);
        
    }

    async function handleSubmit(e) {
        e.preventDefault();
        console.log('form submit');
        console.log(e.target);
        console.log(form['source_url'].value);
        
        //validate URL
        
        const { value } = form['source_url'];
        form['source_url'].value = '';
        console.log(value);
        
        const response = await fetch(`../rpc/app.rpc.php?action=shorten_url&url=${value}`);
        const shortUrl = await response.json();
        console.log(shortUrl);
        
        const shortUrlNew = document.querySelector('.shorten_result > .new');
        shortUrlNew.innerHTML = value;
        const shortUrlOrigin = document.querySelector('.shorten_result > .origin');
        shortUrlOrigin.innerHTML = shortUrl['result'];


        loadList();
    }

    async function loadList() {

        const response = await fetch('../rpc/app.rpc.php?action=read_all');
        data = await response.json();
        console.log(data);

        urlListDisplay.innerHTML = null;
        data.forEach(item => {
            const li = document.createElement('li');
            li.innerHTML = 
            `<div class='source_url'>${item['url']}</div>
            <div class='short_url'><a href='${item['url']}'>http://localhost/dev/thing_or_two/public/${item['short_url']}</a></div>
            <div class='created_at'>${item['created_at']}</div>`;
            urlListDisplay.appendChild(li);
        });
    }

    return {
        init
    }

})();

app.init();
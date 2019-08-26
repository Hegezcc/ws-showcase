$(document).ready(async function () {
    const data = await (fetch('/images.json').then(d => d.json()));

    const root = $('#images');

    for (let i = 0; i < data.length; i++) {
        const el = data[i];

        const template = `
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <img src="${el['path']}" alt="Example" class="thumbnail">
                            <span class="title">${el['title']}</span>
                        </a>
                    </li>`

        root.append(template);
    }

    $('.nav-link').on('click', function() {
        $('a-sky').attr('src', $(this).children('img').attr('src'));
        $('a-text').attr('value', $(this).find('.title').text())
        $('.active').removeClass('active');
        $(this).parent().addClass('active');
    })
})
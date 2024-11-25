document.querySelectorAll('.country, .region, .city').forEach(function(element) { ///все элементы класса их фильтрует
    element.addEventListener('mouseover', function(event) {
        const description = this.getAttribute('data-description');///информацию получение из-за заголовка
        const tooltip = document.createElement('div');
        tooltip.classList.add('tooltip');
        tooltip.innerText = description;
        document.body.appendChild(tooltip);
        tooltip.style.display = 'block';
        tooltip.style.left = event.pageX + 'px';
        tooltip.style.top = event.pageY + 'px';
        this.addEventListener('mousemove', function(event) {
            tooltip.style.left = event.pageX + 'px';
            tooltip.style.top = event.pageY + 'px';
        });
    });///////для мышки чтобы выводило информацию о подсказках
    element.addEventListener('mouseout', function() {
        document.querySelectorAll('.tooltip').forEach(function(tooltip) {
            tooltip.remove();
        });
    });
});

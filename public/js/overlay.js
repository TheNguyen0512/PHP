document.addEventListener('DOMContentLoaded', function() {
    var categoriesAll = document.getElementById('hero_categories_all');
    categoriesAll.addEventListener('click', function() {
        var categories = document.querySelector('.hero__categories ul');
        categories.style.display = (categories.style.display === 'none' || categories.style.display === '') ? 'block' : 'none';
    });
});


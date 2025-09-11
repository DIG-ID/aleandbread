// Accordion functionality
document.addEventListener('DOMContentLoaded', function () {
const accordionItems = document.querySelectorAll('[data-accordion]');
accordionItems.forEach((item) => {
    const header = item.querySelector('.toggle-header');
    const content = item.querySelector('.accordion-content');
    const icon = item.querySelector('.toggle-icon');
    const questionText = item.querySelector('.accordion-question');

    header.addEventListener('click', () => {
    const isOpen = !content.classList.contains('hidden');
    accordionItems.forEach((el) => {
        const contentEl = el.querySelector('.accordion-content');
        const iconEl = el.querySelector('.toggle-icon');
        const textEl = el.querySelector('.accordion-question');
        contentEl.classList.add('hidden');
        contentEl.style.maxHeight = null;
        iconEl.textContent = '+';
        iconEl.classList.remove('text-accent');
        iconEl.classList.add('text-dark');
        textEl.classList.remove('text-accent');
        textEl.classList.add('text-dark');
    });

    if (!isOpen) {
        content.classList.remove('hidden');
        content.style.maxHeight = content.scrollHeight + 'px';
        icon.textContent = '-';
        icon.classList.remove('text-dark');
        icon.classList.add('text-accent');
        questionText.classList.remove('text-dark');
        questionText.classList.add('text-accent');
    }
    });
});
});

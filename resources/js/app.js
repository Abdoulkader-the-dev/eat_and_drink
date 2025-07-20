document.addEventListener('DOMContentLoaded', () => {
    const openBtn = document.getElementById('openStand');
    const cancelBtn = document.getElementById('cancelStand');
    const content = document.getElementById('content');
    const formWrapper = document.getElementById('stand-form');

    if (openBtn) {
        openBtn.addEventListener('click', () => {
            content.hidden = true;
            formWrapper.hidden = false;
        });
    }

    if (cancelBtn) {
        cancelBtn.addEventListener('click', () => {
            formWrapper.hidden = true;
            content.hidden = false;
        });
    }
});

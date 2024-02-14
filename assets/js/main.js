var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })


    const radioButtons = document.querySelectorAll('.radio');
    const selects = document.querySelectorAll('.select');
    const submitButton = document.getElementById('submitinput');

    radioButtons.forEach(radio => {
        radio.addEventListener('change', function() {
            const selectedRadioValue = this.value;

            // Réinitialisez toutes les sélections à la valeur vide et cachez-les
            selects.forEach(select => {
                select.value = '';
                select.classList = 'form-select d-none select';
            });

            // Affichez la sélection correspondante au bouton radio sélectionné
            const relatedSelect = document.querySelector(`.select[data-related-radio="${selectedRadioValue}"]`);
            if (relatedSelect) {
                relatedSelect.classList = 'form-select d-block select';
            }

            // Vérifiez si l'une des sélections a une valeur non vide
            const hasNonEmptyValue = Array.from(selects).some(select => select.value !== '');

            // Vérifiez également si les boutons radio 6, 7 ou 8 sont cochés
            const isSpecialRadioChecked = [6, 7, 8].some(value => value.toString() === selectedRadioValue);

            // Affichez ou masquez le bouton de soumission en fonction des conditions
            if (hasNonEmptyValue || isSpecialRadioChecked) {
                submitButton.classList = 'd-block';
            } else {
                submitButton.classList = 'd-none';
            }
        });
    });

    selects.forEach(select => {
        select.addEventListener('change', function() {
            // Vérifiez si l'une des sélections a une valeur non vide
            const hasNonEmptyValue = Array.from(selects).some(select => select.value !== '');

            // Vérifiez également si les boutons radio 6, 7 ou 8 sont cochés
            const isSpecialRadioChecked = [6, 7, 8].some(value => radioButtons[value - 1].checked);

            // Affichez ou masquez le bouton de soumission en fonction des conditions
            if (hasNonEmptyValue || isSpecialRadioChecked) {
                submitButton.classList = 'd-block';
            } else {
                submitButton.classList = 'd-none';
            }
        });
    });
/* --------------------------------------------------- */
/* Pour affiche ce qui foix pour mettre un commentaire */
/* --------------------------------------------------- */
    const commentTextarea = document.getElementById('commentTextarea');
    const commenterBtn = document.getElementById('commenterBtn');
    const annulerBtn = document.getElementById('annulerBtn');
    const commentButtons = document.getElementById('commentButtons');

    if (document.getElementById("commentTextarea")) {
        const commentTextarea = document.getElementById("commentTextarea");
        const commenterBtn = document.getElementById("commenterBtn");
    
        commentTextarea.addEventListener('input', function() {
            const hasContent = commentTextarea.value.trim().length > 0;
            commenterBtn.disabled = !hasContent;
        });
  


        commentTextarea.addEventListener('focus', function() {
            commentButtons.classList.remove('d-none');
        });


        annulerBtn.addEventListener('click', function() {
            commentTextarea.value = '';
            commentButtons.classList.add('d-none');
            commenterBtn.disabled = true;
        });
    } 
/* ----------------------------------------  */
/* Stystem de lire-plus sur les commentaire  */
/* ----------------------------------------  */
function handleCommentExpansion(commentContent) {
    const maxHeight = 3 * parseInt(getComputedStyle(commentContent).lineHeight, 10);
    const commentHeight = commentContent.clientHeight;

    if (commentHeight > maxHeight) {
        commentContent.classList.add('collapsed');
        const seeMoreBtn = document.createElement('button');
        seeMoreBtn.className = 'see-more-btn btn p-0 autre_video_plus';
        seeMoreBtn.textContent = 'Lire la suite';
        commentContent.parentNode.insertBefore(seeMoreBtn, commentContent.nextSibling);

        seeMoreBtn.addEventListener('click', function() {
            commentContent.classList.toggle('collapsed');
            if (commentContent.classList.contains('collapsed')) {
                seeMoreBtn.textContent = 'Lire la suite';
            } else {
                seeMoreBtn.textContent = 'Moins';
            }
        });
    }
}
document.addEventListener('DOMContentLoaded', function() {
    const commentContents = document.querySelectorAll('.comment-content');

    commentContents.forEach(function(commentContent) {
        handleCommentExpansion(commentContent);
    });
});
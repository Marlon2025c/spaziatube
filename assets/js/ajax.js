
/* --------------- */
/* Pour s'abonner  */
/* --------------- */

$(document).ready(function() {
    $(".subscribe-button, .unsubscribe-button").on("click", function() {
        var userId = $(this).data("user-id");
        var action = $(this).hasClass("subscribe-button") ? "subscribe" : "unsubscribe";

        $.ajax({
            url: "/spaziatube/Social/subscriptionAjax",
            method: "POST",
            data: {
                user_id: userId,
                action: action
            },
            success: function(response) {
                // Masquer ou afficher les boutons en fonction de l'état d'abonnement
                if (action === "subscribe") {
                    $(".subscribe-button").addClass("d-none");
                    $(".unsubscribe-button").removeClass("d-none");
                } else {
                    $(".unsubscribe-button").addClass("d-none");
                    $(".subscribe-button").removeClass("d-none");
                }
                // Mettre à jour le compteur d'abonnés
                $(".subscription-count").text(response + " Abonnés");
            }
        });
    });
});

/* ----------------------------- */
/* Pour like et dislike la vidéo */
/* ----------------------------- */

$(document).ready(function() {
    $(".like-button, .dislike-button").on("click", function() {
        var videoId = $(this).data("video-id");
        var type = $(this).hasClass("like-button") ? "like" : "dislike";

        $.ajax({
            url: "/spaziatube/Media/addLikeDislikeAjax",
            method: "POST",
            data: {
                video_id: videoId,
                type: type
            },
            success: function(response) {
                // Mettez à jour les compteurs de likes/dislikes ici
                var responseData = JSON.parse(response);
                $(".like-count").text(responseData.likes);
                $(".dislike-count").text(responseData.dislikes);
            }
        });
    });
});

/* -----------------------------------------------------  */
/* Pour mettre un like ou un dislike sur les commentaire  */
/* -----------------------------------------------------  */
$(document).ready(function() {
    $('#commentaireContainer').on('click', '.comment-like-button, .comment-dislike-button', function() {
        var commentId = $(this).data('comment-id');
        var type = $(this).hasClass('comment-like-button') ? 'like' : 'dislike';

        var likeCountElement = $('.comment-like-count[data-comment-id="' + commentId + '"]');
        var dislikeCountElement = $('.comment-dislike-count[data-comment-id="' + commentId + '"]');

        $.ajax({
            url: '/spaziatube/Media/addCommentLikeDislikeAjax',
            method: 'POST',
            data: {
                comment_id: commentId,
                type: type
            },
            success: function(response) {
                var responseData = JSON.parse(response);
                likeCountElement.text(responseData.likes);
                dislikeCountElement.text(responseData.dislikes);
                
            }
        });
    });
});

/* ----------------------------- */
/* Pour ajouter en commentaire   */
/* ---------------------------- */
$(document).ready(function() {
    $('#commenterBtn').on('click', function() {
        var commentTextarea = $('#commentTextarea').val();
        var videoId = $('#commentTextarea').data('video-id');

        $.ajax({
            type: "POST",
            url: "/spaziatube/Social/commenterAjax",
            data: {
                commentTextarea: commentTextarea,
                videoId: videoId
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('#commentTextarea').val('');

                    var commentHtml = '<div>' +
                        '<div class="d-flex">' +
                        '<img class="profil_video" src="/spaziatube/uploads/profile/defaut/' + response.profile_image + '" alt="Card image">' +
                        '<div style="padding-left: 10px;">' +
                        '<div class="d-flex">' +
                        '<p>' + response.pseudo + '</p>' +
                        '<p>  Il y a : ' + response.time_ago + '</p>' +
                        '</div>' +
                        '<p class="m-0 comment-text comment-content">' + response.commentaire + '</p>' +
                        '<div class="d-flex btnsocialcommenter">' +
                        '<div class="comment-like-section">' +
                        '<a href="javascript:void(0);" class="comment-like-button" data-comment-id="' + response.commentId + '">' +
                        '<ion-icon name="thumbs-up-outline" class="comment-like-icon"></ion-icon>' +
                        '<span class="comment-like-count" data-comment-id="' + response.commentId + '">' + response.likes + '</span>' +
                        '</a>' +
                        '</div>' +
                        '<div class="comment-dislike-section">' +
                        '<a href="javascript:void(0);" class="comment-dislike-button" data-comment-id="' + response.commentId + '">' +
                        '<ion-icon name="thumbs-down-outline" class="comment-dislike-icon"></ion-icon>' +
                        '<span class="comment-dislike-count" data-comment-id="' + response.commentId + '">' + response.dislikes + '</span>' +
                        '</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';

                    commentButtons.classList.add('d-none');

                    var commentLikeCount = response.commentLikeCount;
                    $('#comment-like-count-' + response.commentId).text(commentLikeCount);

                    var commentDislikeCount = response.commentDislikeCount;
                    $('#comment-dislike-count-' + response.commentId).text(commentDislikeCount);

                    $('#commentaireContainer').append(commentHtml);

                    var newCommentCount = response.newCommentCount;
                    $('#commentCount').text(newCommentCount + ' commentaire');

                    $('#aucunCommentaireMessage').hide();
                    var newCommentContent = $('#commentaireContainer').find('.comment-content').last()[0];

                    handleCommentExpansion(newCommentContent);
                } else {
                    alert('Erreur lors de l\'ajout du commentaire.');
                }
            }
        });
    });
});

function incrementViews(videoId) {
    $.ajax({
        url: "/spaziatube/Social/increment_views/" + videoId,
        type: "POST", 
        success: function(response) {
            if (response.success) {
                var newViewsCount = response.newViewsCount;
                $("#viewsCount").text(newViewsCount);
            }
        }
    });
}
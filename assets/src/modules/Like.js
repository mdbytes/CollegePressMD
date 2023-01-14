import $ from "jquery";

class Like {
  constructor() {
    this.events();
  }

  events() {
    $(".like-box").on("click", this.clickDispatcher);
  }

  clickDispatcher = (evt) => {
    let currentLikeBox = $(evt.target).closest(".like-box");

    if (currentLikeBox.attr("data-exists") == "yes") {
      this.deleteLike(currentLikeBox);
    } else {
      this.createLike(currentLikeBox);
    }
  };

  createLike = (currentLikeBox) => {
    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader("X-WP-Nonce", mainDataJs.nonce);
      },
      url: mainDataJs.root_url + "/wp-json/college/v1/manageLike",
      type: "POST",
      data: {
        professor_id: currentLikeBox.data("professor"),
      },
      success: (response) => {
        currentLikeBox.attr("data-exists", "yes");
        let likeCount = parseInt(currentLikeBox.find(".like-count").html());
        likeCount++;
        currentLikeBox.find(".like-count").html(likeCount);
        currentLikeBox.attr("data-like", response);
        console.log(response);
      },
      error: (response) => {
        console.log(response);
      },
    });
  };

  deleteLike = (currentLikeBox) => {
    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader("X-WP-Nonce", mainDataJs.nonce);
      },
      url: mainDataJs.root_url + "/wp-json/college/v1/manageLike",
      data: {
        like: currentLikeBox.attr("data-like"),
      },
      type: "DELETE",
      success: (response) => {
        currentLikeBox.attr("data-exists", "no");
        let likeCount = parseInt(currentLikeBox.find(".like-count").html());
        likeCount--;
        currentLikeBox.find(".like-count").html(likeCount);
        currentLikeBox.attr("data-like", "");
        console.log(response);
      },
      error: (response) => {
        console.log(response);
      },
    });
  };
}

export default Like;

import $ from "jquery";

class Search {
  // describe and create/initiate our object
  constructor() {
    this.addSearchHTML();
    this.openButton = $(".js-search-trigger");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchField = $("#search-term");
    this.typingTimer;
    this.isSpinningWheel = false;
    this.searchResults = $("#search-overlay__results");
    this.isOpen = false;
    this.previousSearchTerm = "";
    this.events();
  }

  addSearchHTML() {
    $("body").append(`
    <div class="search-overlay">
      <div class="search-overlay__top">
          <div class="container">
              <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
              <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term" autocomplete="off" />
              <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
          </div>
      </div>
      <div class="container">
          <div id="search-overlay__results">

          </div>
      </div>
    </div>
    `);
  }

  // events
  events() {
    this.openButton.on("click", this.openOverlay.bind(this));
    this.closeButton.on("click", this.closeOverlay.bind(this));
    $(document).on("keyup", this.keyPressDispatcher.bind(this));
    this.searchField.on("keydown", this.typingLogic.bind(this));
  }

  // methods (function, action...)
  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll");
    this.searchField.val("");
    setTimeout(() => {
      this.searchField.focus();
    }, 301);
    this.isOpen = true;
    return false;
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");
    this.isOpen = false;
  }

  keyPressDispatcher(evt) {
    // Not making a rule for "s" because it would result in
    // unwanted action for user.

    if (evt.keyCode === 27 && this.isOpen) {
      this.closeOverlay();
    }
  }

  typingLogic() {
    if (this.searchField.val() !== this.previousSearchTerm) {
      clearTimeout(this.typingTimer);
      if (this.searchField.val() !== "") {
        if (!this.isSpinningWheel) {
          this.searchResults.html('<div class="spinner-loader"></div>');
          this.isSpinningWheel = true;
        }
        this.previousSearchTerm = this.searchField.val();
        if (this.searchField.val().length > 2)
          this.typingTimer = setTimeout(this.getResults.bind(this), 750);
      } else {
        this.resultsDiv.html("");
        this.isSpinningWheel = false;
      }
    }
  }

  getResults() {
    $.getJSON(
      mainDataJs.root_url +
        "/wp-json/college-rest-api/v1/search?term=" +
        this.searchField.val(),
      (results) => {
        this.searchResults.html(`
        <div class="row">
          <div class="one-third">
            <h2 class="search-overlay__section-title">General Information</h2>
            ${
              results.generalInfo.length === 0
                ? `<p>No pages or posts for that search term.</p>`
                : results.generalInfo
                    .map(
                      (result) =>
                        `<li><a href="${result["url"]}">
                            ${result["title"]}</a> ${
                          result["postType"] === "post"
                            ? `by ${result["authorName"]}`
                            : ""
                        }</li>`
                    )
                    .join("")
            }
          </div>
          <div class="one-third">
            <h2  class="search-overlay__section-title">Programs</h2>
            ${
              results.programs.length === 0
                ? `<p>No programs for that search term.  <a href="${mainDataJs.root_url}/programs">View all programs</a></p>`
                : results.programs
                    .map(
                      (result) =>
                        `<li><a href="${result["url"]}">${result["title"]}</a></li>`
                    )
                    .join("")
            }
            <h2  class="search-overlay__section-title">Professors</h2>
            ${
              results.professors.length === 0
                ? `<p>No professors from that search.</p>`
                : results.professors
                    .map(
                      (result) =>
                        `
                        <li class="professor-card__list-item">
                          <a class="professor-card" href="${result.url}">
                          <img class="professor-card__image" src="${result.image}">
                          <span class="professor-card__name">${result.title}</span>
                          </a>
                        </li>
                        `
                    )
                    .join("")
            }
          </div>
          <div class="one-third">
            <h2  class="search-overlay__section-title">Campuses</h2>
            ${
              results.campuses.length === 0
                ? `<p>No campuses for that search term.  <a href="${mainDataJs.root_url}/campuses">View all campuses</a></p>`
                : results.campuses
                    .map(
                      (result) =>
                        `<li><a href="${result["url"]}">${result["title"]}</a></li>`
                    )
                    .join("")
            }
            <h2  class="search-overlay__section-title">Events</h2>
            ${
              results.events.length === 0
                ? `<p>No events from that search.  <a href="${mainDataJs.root_url}/events">View all events</a></p></p>`
                : results.events
                    .map(
                      (result) =>
                        `
                        <div class="event-summary">
                            <a class="event-summary__date t-center" href="${result.url}>">
                                <span class="event-summary__month">${result.month}</span>
                                <span class="event-summary__day">${result.day}</span>
                            </a>
                            <div class="event-summary__content">
                                <h5 class="event-summary__title headline headline--tiny"><a href="${result.url}">${result.title}</a></h5>
                                <p>${result.excerpt}<a href="${result.url}" class="nu gray">...Learn more</a></p>
                            </div>
                        </div>
                        `
                    )
                    .join("")
            }
          </div>
        </div>
        `);
      }
    );
    this.isSpinningWheel = false;
  }
}

export default Search;

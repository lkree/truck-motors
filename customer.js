const h = {
  /**
   *
   * @param link string
   * @param resultHandlerType string
   * @param cb function
   */
  fetch: (link, resultHandlerType, cb) => {
     fetch(link)
      .then(data => data[resultHandlerType]())
       .then(data => cb(data))
  },
};
{
  /**
   *
   * @param isUserLogin boolean
   */
  const headerLinksTransfer = (isUserLogin) => {
    if (!isUserLogin) return;
    /**
     * w -> wrapper for chaining operations
     */
    const w = () => {
      let links, pcLink, mobileLink;

      w.getLinks = () => {
        links = [...document.querySelectorAll('.sp-megamenu-parent .sp-menu-item a, .sp-module-content ul.menu a')]
          .filter((el) => el.href === 'https://truck-motors.su/customer-index-html.html');

        return w;
      };
      w.changeHref = () => {
        links.forEach(link => link.href = 'https://truck-motors.su/customer/index.html');

        return w;
      };
      w.initiateLink = () => {
        [pcLink, mobileLink] = links;

        return w;
      };
      w.addClass = () => {
        pcLink.parentElement.classList.add('profile-link');

        return w;
      };
      w.handleUserName = () => {
        const setUserName = (name) => {
          links.forEach(link => link.textContent = name);
        };
        h.fetch('https://truck-motors.su/81-fetch.html?getName=y', 'text', setUserName);

        return w;
      };

      return w;
    };

    w()
      .getLinks()
      .changeHref()
      .initiateLink()
      .addClass()
      .handleUserName();
  };

  const loginUserLink = 'https://truck-motors.su/81-fetch.html?isLogin=y';
  h.fetch(loginUserLink, 'text', headerLinksTransfer);
}

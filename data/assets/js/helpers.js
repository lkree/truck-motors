window.h = {
  checkAvailable: (element, substitute = '') => element || substitute,
  getText: (element) => element ? element.textContent : '',
  handleClass: (element, action, className) => element.classList[action](className),
  hasClass: (element, className) => element.classList.contains(className),
  escapeHtml: (text) => {
    const map = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#039;'
    };

    return text.replace(/[&<>"']/g, (m) => map[m]);
  },
  setDataSet: (element, dataType, value) => element.dataset[dataType] = value,
  getDataSet: (element, dataType) => element.dataset[dataType],
  clearelement: (element) => element.innerHTML = '',
  removeelement: (element) => element = null,
  hide: (element) => h.handleClass(element, 'add', 'hidden'),
  show: (element) => h.handleClass(element, 'remove', 'hidden'),
  addClass: (element, className) => h.handleClass(element, 'add', className),
  removeClass: (element, className) => h.handleClass(element, 'remove', className),
  hideAll: (list) => [...list].forEach(h.hide),
  showAll: (list) => [...list].forEach(h.show),
  setText: (element, text) => element.textContent = text,
  eventAdd: (element, event, handler) => element.addEventListener(event, handler),
  eventRemove: (element, event, handler) => element.removeEventListener(event, handler),
  isMatch: (element, matchElement) => element === matchElement,
  removelementistOfEvents: (list, filter) => {
    list
      .filter((element) => element[filter])
      .forEach((e) => h.eventRemove(e.element, e.ev, e.listener))
  },
  addListOfEvents: (list, filter) => {
    list
      .filter((element) => element[filter])
      .forEach((e) => h.eventAdd(e.element, e.ev, e.listener))
  },
  setWaitScreen: (waitScreen) => h.show(waitScreen),
  removeWaitScreen: (waitScreen) => h.hide(waitScreen),
  lowerCase: (element) => element.toLowerCase(),
  checkSubString: (string, subString) => {
    string = h.lowerCase(string);
    subString = h.lowerCase(subString);

    return !!~string.indexOf(subString);
  },
};
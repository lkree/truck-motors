{
  const option = {
    wrapper: document.querySelector('.customer-cars'),
    waitScreen: document.querySelector('.wait-screen'),
    template: document.querySelector('.customers-history__tbody-template'),
  };
  const props = Object.assign(option, {
    select: option.wrapper.querySelector('.customers-history__documents-list'),
    tableHeader: option.wrapper.querySelector('.customer-history__car-name-header'),
    table: option.wrapper.querySelector('.customer-cars__table'),
  });

  const selectHandler = (props, {target: {value: carId}}) => {
    const w = ({waitScreen, template}) => {
      w.setWaitScreen = () => {
        h.setWaitScreen(waitScreen);

        return w;
      };
      w.handleData = () => {
        const fetchUrl = carId === 'all' ?
          'https://truck-motors.su/81-fetch.html?req=getAllDocuments' :
          `https://truck-motors.su/81-fetch.html?req=getDocument&car_id=${carId}`;

        fetch(fetchUrl)
          .then(result => result.json())
          .then(result => w.renderResult())
          .then(() => h.removeWaitScreen(waitScreen))
          .catch(() => h.removeWaitScreen(waitScreen));

        return w;
      };
      /**
       *
       * @param data array
       */
      w.renderResult = (data) => {
        let fragment;

        const s = (data) => {
          const createTd = ({document_id, status, date}) => {

          };
          s.createFragment = () => {
            fragment = document.createDocumentFragment();

            return s;
          };
          s.handleTemplate = () => {
            data.forEach(createTd);

            return s;
          };
          s.insertTemplate = () => {


            return s;
          };

          return s;
        };

        s(data)
          .createFragment()
          .handleTemplate()
          .insertTemplate();

        return w;
      };

      return w;
    };

    w(props)
      .setWaitScreen()
      .handleData()
  };
  const onSelectChange = selectHandler.bind(null, props);

  props.select.addEventListener('change', onSelectChange);
}
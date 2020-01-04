{
  const option = {
    wrapper: document.querySelector('.customer-cars'),
    waitScreen: document.querySelector('.wait-screen'),
    tableTemplate: document.querySelector('.customers-history__table-template').content,
    worksTemplate: document.querySelector('.customers-history__works-template').content,
  };
  const props = {
    ...option,
    select: option.wrapper.querySelector('.customers-history__documents-list'),
    tableHeader: option.wrapper.querySelector('.customer-history__car-name-header'),
    table: option.wrapper.querySelector('.customer-cars__table'),
    documentTableTemplate: option.tableTemplate.querySelector('.customer-cars__table-tbody'),
    worksTemplateWrapper: option.worksTemplate.querySelector('.customer-cars__works'),
  };

  const selectHandler = (props, {target: {value: carId}}) => {
    const w = ({waitScreen, documentTableTemplate, table, tableHeader}, carId) => {
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
          .then(result => {
            w.clearOldData();
            return result;
          })
          .then(result => w.renderResult(result))
          .then(() => w.setHeader())
          .then(() => h.removeWaitScreen(waitScreen))
          .catch((error) => {
            console.log(error);
            h.removeWaitScreen(waitScreen)
          });

        return w;
      };
      /**
       *
       * @param data array
       */
      w.renderResult = (data) => {
        let wrapper;

        const s = (data, documentTableTemplate, table) => {
          const createTr = ({document_id, status, date}, index) => {
            const tr = documentTableTemplate.querySelector('.customer-cars__table-tbody-tr').cloneNode();

            if (index % 2 === 1) h.addClass(tr, 'customer-cars__table-tbody-tr--grey');
            tr.dataset.documentId = document_id;

            tr.append(...[document_id, status, date, '>>>'].map((el) => {
              const td = documentTableTemplate.querySelector('.customer-cars__table-td').cloneNode();
              h.setText(td, el);
              return td;
            }));

            return tr;
          };
          s.createWrapper = () => {
            wrapper = documentTableTemplate.cloneNode();

            return s;
          };
          s.handleWrapper = () => {
            wrapper
              .append(...data.map(createTr));

            return s;
          };
          s.insertWrapper = () => {
            table.append(wrapper);

            return s;
          };

          return s;
        };

        s(data, documentTableTemplate, table)
          .createWrapper()
          .handleWrapper()
          .insertWrapper();

        return w;
      };
      w.clearOldData = () => {
        h.removeElement(table.querySelector('.customer-cars__table-tbody'));

        return w;
      };
      w.setHeader = () => {
        carId === 'all' ?
          h.setText(tableHeader, 'Все документы') :
          fetch(`https://truck-motors.su/81-fetch.html?req=getCar&car_id=${carId}`)
          .then(result => result.json())
          .then((cars) => h.setText(tableHeader, cars[0].model))
          .catch((error) => console.log(error));

        return w;
      };

      return w;
    };

    w(props, carId)
      .setWaitScreen()
      .handleData()
  };
  const onSelectChange = selectHandler.bind(null, props);

  const tableHandler = (props, {target}) => {
    if (target.tagName !== 'TD') return;

    const w = ({waitScreen, worksTemplateWrapper, worksTemplate, table}, target) => {
      let currentTr, documentId, fastExit = false;

      w.checkRender = () => {
        let isRendered, nextElement;
        try {
          nextElement = currentTr.nextElementSibling;
          isRendered = nextElement.matches('.customers-history__work-tr');
        } catch(e) {
          isRendered = false;
        }

        /**
         * if el already rendered close all and handle it
         * else close all then render new el
         */
        if (isRendered) {
          w.handleExistingElement(nextElement);
          fastExit = true;
        }
        else w.handleExistingElement();

        return w;
      };
      /**
       *
       * @param currentElement HTMLElement
       * checks element for close class and closes over elements
       */
      w.handleExistingElement = (currentElement = document.createElement('div')) => {
        const isClosed = currentElement.classList.contains('customers-history__work-tr--closed');
        [...table.querySelectorAll('.customers-history__work-tr')].forEach((tr) => {
          h.addClass(tr, 'customers-history__work-tr--closed-animation');
          /**
           * just makes table animation
           */
          setTimeout(() => h.addClass(tr, 'customers-history__work-tr--closed'), 500);
        });

        if (isClosed) {
          setTimeout(() => {
            h.removeClass(currentElement, 'customers-history__work-tr--closed-animation');
            h.removeClass(currentElement, 'customers-history__work-tr--closed');
          }, 500);
        }

        return w;
      };
      w.renderResult = (data) => {
        const s = (data) => {
          let wrapper;
          const createWorkItem = ({works}) => {
            const div = worksTemplateWrapper.querySelector('.customer-cars__work-item').cloneNode();
            h.setText(div, works);

            return div;
          };

          s.createWrapper = () => {
            wrapper = worksTemplateWrapper.cloneNode();

            return s;
          };
          s.handleWrapper = () => {
            if (data.length === 0) wrapper.append(...[{works: 'работы не найдены'}].map(createWorkItem));
            else wrapper.append(...data.map(createWorkItem));

            return s;
          };
          s.insertWrapper = () => {
            const tempTr = worksTemplate.querySelector('tr').cloneNode(true);

            tempTr.querySelector('td').append(wrapper);
            currentTr.parentElement.insertBefore(tempTr, currentTr.nextElementSibling);

            return s;
          };

          return s;
        };

        s(data)
          .createWrapper()
          .handleWrapper()
          .insertWrapper();

        return w;
      };
      w.setWaitScreen = () => {
        if (!fastExit) h.setWaitScreen(waitScreen);

        return w;
      };
      w.getCurrentTr = () => {
        currentTr = target.parentElement;

        return w;
      };
      w.getDocumentId = () => {
        if (!fastExit) documentId = h.getDataSet(currentTr, 'documentId');

        return w;
      };
      w.handleData = () => {
        if (fastExit) return w;
          fetch(`https://truck-motors.su/81-fetch.html?req=getWork&document_id=${documentId}`)
          .then(result => result.json())
          .then(result => w.renderResult(result))
          .then(() => h.removeWaitScreen(waitScreen));

        return w;
      };

      return w;
    };

    w(props, target)
      .getCurrentTr()
      .checkRender()
      .setWaitScreen()
      .getDocumentId()
      .handleData();
  };
  const onTableClick = tableHandler.bind(null, props);

  props.select.addEventListener('change', onSelectChange);
  props.table.addEventListener('click', onTableClick);
}
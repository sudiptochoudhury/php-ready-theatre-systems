import axios from "axios";
import parseXml from './parseXml.js';
import renderLayout from './renderLayout.js';
import $ from "jquery";

let xmlString;
let xml;
let conf = {};

export default {
  name: 'app',
  data: function () {
    return {
      selectMessage: "Wait loading data...",
      sectionName: '',
      xml: [],
      layouts: [],
      layout: '',
      config: {},
    }
  },
  created: function () {
    const vm = this;
    axios.get('global-seat-layouts.xml').then(
      response => {
        xmlString = response.data;
        vm.xml = xml = parseXml(xmlString)
        vm.layouts = parseLayouts(xml && xml.Layouts || []);
        vm.selectMessage = "Select a layout";

        vm.config.gridWidth = xml.GridRef.Width;
        vm.config.gridHeight = xml.GridRef.Height;
        conf = vm.config;

        adjustView.call(vm);

      }
    );
  },
  methods: {
    renderSeats() {
      renderLayout.call(this);
    }
  }

}


function adjustView() {
  const vm = this;
  const config = vm.config;
  const gWidth = parseFloat(config.gridWidth);
  const gHeight = parseFloat(config.gridHeight);
  const gRatio = gWidth / gHeight;
  vm.config.gRatio = gRatio;

  const seatsContainer = $('.auditorium .seats');
  let width = seatsContainer.width();
  let height = seatsContainer.height();
  const minWH = Math.min(width, height);
  // console.log({gWidth, gHeight, gRatio, width, height, minWH});
  if (width > minWH) {
    let newWidth = Math.floor(height * gRatio);
    let delta = Math.floor((width - newWidth) / 2);
    width = newWidth;
    // console.log({width, delta});
    seatsContainer.css({
      'width': null,
      'left': delta + 'px',
      'right': delta + 'px',
    });
  } else if (height > minWH) {
    height = Math.floor(1/gRatio * width);
    // console.log({height});
    seatsContainer.css({
      'bottom': null,
      'height': height + 'px'
    });
  }
  // console.log({gWidth, gHeight, gRatio, width, height, minWH});

  /*
    Your grid width divided by our grid width = your X ratio
    Your grid height divided by our grid height = your Y ratio
    Our Xpos multiplied by X ratio = your Xpos
    Our Ypos multiplied by Y ratio = your Ypos
    Our Width multiplied by X ratio = your width
    Our Height multiplied by Y ration = your height

   */
  vm.config.width = width;
  vm.config.height = height;

  vm.config.xRatio = width / gWidth;
  vm.config.yRatio = height / gHeight;

  $(document).on('click', '.seats .seat', function () {
    let elm = $(this);
    let footer = $('.footer');
    let sel = elm.data('isSelected');
    sel = !sel;
    elm.data('isSelected', sel);
    if (sel) {
      elm.addClass('selected');
      const clone = elm.clone().addClass('clone').appendTo(footer);
      elm.data('clone', clone);
    }
    else {
      const clone = elm.data('clone');
      if (clone && clone.remove) {
        clone.remove();
      }
      elm.removeClass('selected');
    }
  });


}

function parseLayouts(layouts) {
  let data = {};
  for(let index in layouts) {
    let layout = layouts[index];
    if (!layout.Seats || !layout.Seats.length) {
      continue;
    }
    const name = layout['LayoutName'];
    data[name] = layout;
  }
  return data;
}
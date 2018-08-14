import $ from 'jquery';
import bootstrap from 'bootstrap';

let gSeatTypes = null;

function parseSeatTypes(seats) {
  let data = {};
  for(let index in seats) {
    let seat = seats[index];
    data[seat['ID']] = seat['CustomerName'];
  }
  gSeatTypes = data;
  return data;
}
export default function renderLayout() {
  const vm = this;
  const layoutName = vm.layout;
  const layouts = vm.layouts;
  const layout = layouts[layoutName];
  const seats = layout.Seats || {};
  const config = vm.config;
  const xRatio = parseFloat(config.xRatio);
  const yRatio = parseFloat(config.yRatio);
  // console.log({config, gWidth, gHeight, gRatio});

  const xml = vm.xml;
  // console.log(layout);
  const seatTypes = gSeatTypes || parseSeatTypes(xml.SeatTypes);

  const seatsContainer = $('.auditorium .seats');


  vm.sectionName = layout.SectionName || '';

  seatsContainer.find('.seat').tooltip('dispose');
  seatsContainer.empty();

  for(let index in seats) {
    let seat = seats[index];
    let sXpos = parseFloat(seat.XPos);
    let sYpos = parseFloat(seat.YPos);
    let sxWidth = parseFloat(seat.Width);
    let sxHeight = parseFloat(seat.Height);

    let xPos = Math.floor(sXpos * xRatio) + 1;
    let yPos = Math.floor(sYpos * yRatio) + 1;
    let bWidth = Math.floor(sxWidth * xRatio) - 2;
    let bHeight = Math.floor(sxHeight * yRatio) - 2;
    // console.log([sXpos, sYpos, sxWidth, sxHeight, xRatio, yRatio]);
    // console.log([xPos, yPos, bWidth, bHeight]);

    let seatType = seat.TypeID && seatTypes[seat.TypeID] || '';

    let elm = $('<div class="seat "></div>');
    elm.addClass('sType', seat.TypeID || '');
    elm.css({
      'top': yPos + 'px',
      'left': xPos + 'px',
      'width': bWidth + 'px',
      'height': bHeight + 'px',
    });

    elm.data('seatData', seat);
    elm.data('seatType', seatType);
    let details = $("<small>" + seat.RowDesc + seat.ColDesc + "</small>").appendTo(elm);

    let tip = ['Seat Type: ' + seatType];
    for(let i in seat) {
      let item = seat[i];
      tip.push(i + ': ' + item);
    }

    elm.attr({'title': tip.join("\r\n"), 'data-toggle': 'tooltip'});
    elm.appendTo(seatsContainer);

  }

  seatsContainer.find('[data-toggle=tooltip]').tooltip();

}
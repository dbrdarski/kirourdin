import PhotoSwipe from 'photoswipe/dist/photoswipe';
import PhotoSwipeUI_Default from 'photoswipe/dist/photoswipe-ui-default';

let PhotoGallery = (itemSelector) => {

  let items = Array.from(document.querySelectorAll(itemSelector));
  let parseItems = items => items.map(item => ({
    src: item.href,
    msrc: item.dataset.msrc,
    w: item.dataset.w,
    h: item.dataset.h
  }))
  let pswp = document.querySelector('.pswp');
  let click = (items, options = {index: 3}) => (e) =>  {
    e.preventDefault()
    console.log({items, target: e.target})
    new PhotoSwipe(
      pswp,
      PhotoSwipeUI_Default,
      parseItems(items),
      {
        index: items.indexOf(e.target),
        allowPanToNext: true,
        getThumbBoundsFn: function(index) {
          // find item element
          var item = items[index];
          var rect = item.getBoundingClientRect();
          var scaleW = item.dataset.w / rect.width;
          var cropH = ( item.dataset.h / scaleW ) - rect.height;
          var cropH = cropH > 0 ? cropH / 2 : 0;
          var cropW = 0;
          if (item.dataset.w < item.dataset.h){
            var scaleH = item.dataset.h / rect.height;
            var cropW = ( item.dataset.w / scaleH ) - rect.width;
            var cropW = cropW > 0 ? cropW / 2 : 0;
          }
          // console.log(cropH)
          // get window scroll Y
          var pageYScroll = window.pageYOffset || document.documentElement.scrollTop;
          // optionally get horizontal scroll
          // get position of element relative to viewport
          // w = width
          // console.log({rect})
          return {x:rect.left - cropW, y:rect.top + pageYScroll - cropH, w:rect.width, h: rect.height};
        }
      }
    ).init();
  };
  items.forEach( el => el.addEventListener('click', click(items)))
}
export default PhotoGallery;

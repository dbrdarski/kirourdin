export default function ({src, defer, async}){
  let tag = document.createElement('script');
  tag.src = src;
  tag.defer = defer;
  tag.async = async;
  document.querySelector('body').appendChild(tag)
}

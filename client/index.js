import PhotoGallery from './photoswipe'
import Masonry from 'masonry-layout'
import maps from './maps'

document.addEventListener("DOMContentLoaded", function() {
  let googleMapsApiKey = 'AIzaSyA5fuL7uRPVw2x3LfcmkD0ne01-NylVnGA';


  PhotoGallery('.img-list > a.photoswipe, .gallery > .gallery-inner > a.photoswipe')

  let elem = document.querySelector('.gallery.artwork')
  let msnry = elem && new Masonry( elem, {
    // options
    percentPosition: true,
    itemSelector: '.scroll-gallery-item, .text-card',
    columnWidth: '.gallery > .gallery-inner > a'
  })
  const mouche = {
    name: 'Mouche Gallery',
    id: 'ChIJGWBTgvi7woARlItlQljAXRs'
  }
  maps('#google-map', googleMapsApiKey)(mouche)
})

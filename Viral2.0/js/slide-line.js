'use strict';

// (function () {
//     window.addEventListener('wheel', function(e) {
//         if (e.target.classList.contains('text-block')) {
//             e.stopPropagation;
//             return false;
//         }
//         if (e.deltaY < 0) {
//             $('.slide').slick('slickPrev');
//         }
//         if (e.deltaY > 0) {
//             $('.slide').slick('slickNext');
//         }
//     });
// })();

// var j$ = jQuery,
//     $slide = j$(".slide"),
//     $slideLine = j$("#slide-line"),
//     $currentItem = j$(".current-item");

// j$(function(){  
//   // Menu has active item
//   if ($currentItem[0]) {
//     $slideLine.css({
//       "width": $currentItem.width(),
//       "left": $currentItem.position().left
//     });
//   }
  
//   // Underline transition
//   j$($slide).find("div").hover(
//     // Hover on
//     function(){
//       $slideLine.css({
//         "width": j$(this).width(),
//         "left": j$(this).position().left
//       });
//     },
//     // Hover out
//     function(){
//       if ($currentItem[0]) {
//         // Go back to current
//         $slideLine.css({
//           "width": $currentItem.width(),
//           "left": $currentItem.position().left
//         });
//       } else {
//         // Disapear
//         $slideLine.width(0);
//       }
//     }
//    );
// });
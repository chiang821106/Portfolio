// 卷軸動畫
function myScrollY() {
    var textAnimation = document.querySelectorAll('.textAnimationY');
    // 遍歷每個CLASS
    textAnimation.forEach((textAnimation) => {
        var textPosition = textAnimation.getBoundingClientRect().top;
        var screenPosition = window.innerHeight / 1.5;
        if (screenPosition > textPosition) {
            textAnimation.classList.add('appearY');
        }
    }
    )
}

window.addEventListener('scroll', myScrollY);



export function indicadores() {
  const boxes = document.querySelectorAll(".circle-box");
  boxes.forEach(box => {
    const number = box.querySelector(".number");
    const progress = box.querySelector(".progress");
    const target = +box.dataset.target;
    const color = box.dataset.color;

    progress.style.stroke = color;

    if (target === 0) {
      number.textContent = 0;
      progress.style.strokeDashoffset = 408
      return;
    }

    let count = 0;
    const duration = 2000;
    const stepTime = Math.floor(duration / target);
    const counter = setInterval(() => {
      count++;
      number.textContent = count;
      if (count >= target) clearInterval(counter);
    }, stepTime);

    // animar trazo circular
    const offset = 408 - (408 * target) / 100;
    progress.style.strokeDashoffset = offset;
  });
}

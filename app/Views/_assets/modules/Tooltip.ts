import { createPopper, Placement } from "@popperjs/core";

const Tooltip = (): void => {
  const tooltipContainers: NodeListOf<HTMLElement> = document.querySelectorAll(
    "[data-toggle='tooltip']"
  );

  for (let i = 0; i < tooltipContainers.length; i++) {
    const tooltipReference = tooltipContainers[i];
    const tooltipContent = tooltipReference.title;

    const tooltip = document.createElement("div");
    tooltip.setAttribute("id", "tooltip" + i);
    tooltip.setAttribute(
      "class",
      "px-2 py-1 text-sm bg-gray-900 text-white rounded max-w-xs z-50"
    );
    tooltip.innerHTML = tooltipContent;

    const popper = createPopper(tooltipReference, tooltip, {
      placement: tooltipReference.dataset.placement as Placement,
      modifiers: [
        {
          name: "offset",
          options: {
            offset: [0, 8],
          },
        },
      ],
    });

    const show = () => {
      tooltipReference.removeAttribute("title");
      tooltipReference.setAttribute("aria-describedby", "tooltip" + i);
      document.body.appendChild(tooltip);
      popper.update();
    };

    const hide = () => {
      const element = document.getElementById("tooltip" + i);
      tooltipReference.removeAttribute("aria-describedby");
      tooltipReference.setAttribute("title", tooltipContent);
      if (element) {
        document.body.removeChild(element);
      }
    };

    const showEvents = ["mouseenter", "focus"];
    const hideEvents = ["mouseleave", "blur"];

    showEvents.forEach((event) => {
      tooltipReference.addEventListener(event, show);
    });

    hideEvents.forEach((event) => {
      tooltipReference.addEventListener(event, hide);
    });
  }
};

export default Tooltip;

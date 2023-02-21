import {
  arrow,
  computePosition,
  flip,
  offset,
  Placement,
  shift,
} from "@floating-ui/dom";

const Tooltip = (): void => {
  const tooltipContainers: NodeListOf<HTMLElement> =
    document.querySelectorAll("[data-tooltip]");

  for (let i = 0; i < tooltipContainers.length; i++) {
    const tooltipReference = tooltipContainers[i];
    const tooltipContent = tooltipReference.title;

    const tooltip = document.createElement("div");
    tooltip.setAttribute("id", "tooltip" + i);
    tooltip.setAttribute(
      "class",
      "absolute px-2 py-1 text-sm bg-gray-900 text-white rounded max-w-xs z-50"
    );
    tooltip.innerHTML = tooltipContent;
    const arrowElement = document.createElement("div");
    arrowElement.setAttribute(
      "class",
      "absolute bg-gray-900 w-2 h-2 rotate-45"
    );
    arrowElement.setAttribute("id", "arrow" + i);
    tooltip.appendChild(arrowElement);

    const update = () => {
      computePosition(tooltipReference, tooltip, {
        placement: tooltipReference.dataset.tooltip as Placement,
        middleware: [
          flip(),
          shift(),
          offset(8),
          arrow({ element: arrowElement }),
        ],
      }).then(({ x, y, placement, middlewareData }) => {
        Object.assign(tooltip.style, {
          left: `${x}px`,
          top: `${y}px`,
        });

        // Accessing the data
        const { x: arrowX, y: arrowY } = middlewareData.arrow as any;

        const staticSide = {
          top: "bottom",
          right: "left",
          bottom: "top",
          left: "right",
        }[placement.split("-")[0]];

        Object.assign(arrowElement.style, {
          left: arrowX != null ? `${arrowX}px` : "",
          top: arrowY != null ? `${arrowY}px` : "",
          right: "",
          bottom: "",
          [staticSide as string]: "-4px",
        });
      });
    };

    const showTooltip = () => {
      tooltipReference.removeAttribute("title");
      tooltipReference.setAttribute("aria-describedby", "tooltip" + i);
      document.body.appendChild(tooltip);
      update();
    };

    const hideTooltip = () => {
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
      tooltipReference.addEventListener(event, showTooltip);
    });

    hideEvents.forEach((event) => {
      tooltipReference.addEventListener(event, hideTooltip);
    });
  }
};

export default Tooltip;

<script>
  import { onMount } from "svelte";

  let container;

  onMount(async () => {
    const { tsParticles } = await import("@tsparticles/engine");
    const { loadFull } = await import("tsparticles");

    await loadFull(tsParticles);

    const instance = await tsParticles.load({
      id: "weather-particles",
      options: {
        fullScreen: { enable: false },
        detectRetina: true,
        fpsLimit: 60,
        particles: {
          number: { value: 0 },
        },
        emitters: [
          {
            direction: "bottom",
            position: { x: 50, y: 0 },
            rate: { quantity: 2, delay: 0.4 },
            size: { width: 100, height: 0 },
            particles: {
              color: { value: "#ffffff" },
              shape: { type: "circle" },
              opacity: {
                value: { min: 0.3, max: 0.9 },
              },
              size: {
                value: { min: 2, max: 6 },
              },
              move: {
                enable: true,
                speed: { min: 0.5, max: 2 },
                direction: "bottom",
                straight: false,
                outModes: { default: "out" },
              },
              wobble: {
                enable: true,
                distance: 10,
                speed: { min: 2, max: 6 },
              },
              life: {
                duration: { sync: false, value: { min: 4, max: 8 } },
                count: 1,
              },
            },
          },
          {
            direction: "bottom",
            position: { x: 50, y: 0 },
            rate: { quantity: 3, delay: 0.15 },
            size: { width: 100, height: 0 },
            particles: {
              color: { value: "#aec2e0" },
              shape: { type: "line" },
              opacity: {
                value: { min: 0.3, max: 0.7 },
              },
              size: {
                value: { min: 10, max: 22 },
              },
              move: {
                enable: true,
                speed: { min: 10, max: 18 },
                direction: "bottom",
                straight: true,
                outModes: { default: "out" },
              },
              wobble: { enable: false },
              life: {
                duration: { sync: false, value: { min: 1, max: 3 } },
                count: 1,
              },
            },
          },
        ],
        interactivity: {
          detectsOn: "canvas",
          events: {
            onHover: { enable: false },
            onClick: { enable: false },
          },
        },
      },
    });

    return () => {
      if (instance) {
        instance.destroy();
      }
    };
  });
</script>

<div bind:this={container} id="weather-particles" class="weather-container"></div>

<style>
  .weather-container {
    position: absolute;
    inset: 0;
    pointer-events: none;
    z-index: 1;
  }

  .weather-container :global(canvas) {
    display: block;
    width: 100% !important;
    height: 100% !important;
  }
</style>

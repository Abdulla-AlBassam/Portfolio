<script lang="ts">
  import { onMount, type Snippet } from "svelte";

  interface Props {
    delay?: number;
    threshold?: number;
    children: Snippet;
  }

  let { delay = 0, threshold = 0.1, children }: Props = $props();

  let element: HTMLDivElement;
  let visible = $state(false);

  onMount(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          visible = true;
          observer.disconnect();
        }
      },
      { threshold }
    );

    observer.observe(element);
    return () => observer.disconnect();
  });
</script>

<div
  bind:this={element}
  class="transition-all duration-700 ease-out {visible
    ? 'opacity-100 translate-y-0'
    : 'opacity-0 translate-y-6'}"
  style="transition-delay: {delay}ms"
>
  {@render children()}
</div>

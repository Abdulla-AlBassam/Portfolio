<script lang="ts">
  interface Props {
    label: string;
    title: string;
    description?: string;
  }

  let { label, title, description }: Props = $props();
</script>

<div class="text-center mb-16">
  <span
    class="inline-block px-3 py-1 rounded-full border border-accent/20 text-xs font-mono text-accent mb-4"
  >
    {label}
  </span>
  <h2 class="text-3xl sm:text-4xl font-bold tracking-tight">{title}</h2>
  {#if description}
    <p class="mt-3 text-text-secondary max-w-lg mx-auto">{description}</p>
  {/if}
</div>

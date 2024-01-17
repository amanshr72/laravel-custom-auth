<x-app-layout>

    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-4 mx-auto lg:gap-8 xl:gap-0 lg:py-8 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-12">
                <h1 class="max-w-2xl mb-4 text-2xl py-4 font-semibold text-gray-800 tracking-tight leading-none md:text-5xl xl:text-2xl dark:text-white">
                    Hi, <span class="underline underline-offset-3 decoration-4 decoration-blue-400 dark:decoration-blue-600">{{ Auth::user()->name }}</span>
                </h1>
                <h3 id="quote-list" class="max-w-2xl mb-4 text-4xl font-semibold text-gray-800 tracking-tight leading-none md:text-5xl xl:text-4xl dark:text-white">
                    <!-- Quote here -->    
                </h3>
                <span class="py-4"></span>
                <button type="button" id="refresh-btn" class="inline-flex items-center justify-center px-5 py-2 text-base font-medium text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Refresh
                </button> 
            </div>               
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const refreshButton = document.getElementById('refresh-btn');
            const quoteDisplay = document.getElementById('quote-list');
    
            async function fetchQuote() {
                try {
                    refreshButton.innerText = 'loading...';
                    const response = await fetch('/api/quotes');

                    if (!response.ok) {
                        throw new Error('Failed to fetch quote');
                    }

                    const data = await response.json();
                    displayQuote(data['quote']);

                } catch (error) {
                    console.error('Error fetching quote:', error.message);
                    quoteDisplay.innerText = 'Failed to fetch quote. Please try again.';
                }finally {
                    refreshButton.innerText = 'Refresh';
                }
            }
    
            function displayQuote(quote) {
                quoteDisplay.innerText = quote;
            }
    
            refreshButton.addEventListener('click', fetchQuote);    
            fetchQuote();
        });
    </script>
</x-app-layout>
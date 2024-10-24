@extends('dashboard.layouts.master')

@section('title', 'Home')

@push('style')

@endpush

@section('main')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

  <main class="main-content w-full pb-8">
    <div class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
      <div class="col-span-12 sm:col-span-12">
        <div class="my-3 flex items-center justify-between px-4 sm:px-5">
          <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
            Home
          </h2>
        </div>
        <div class="mt-4 grid grid-cols-4 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
          <div class="card flex-row justify-between p-4">
            <div>
              <p class="text-xs+ uppercase">Users</p>
              <div class="mt-8 flex items-baseline space-x-1">
                <p class="text-2xl font-semibold text-slate-700 dark:text-navy-100">
                  {{ $userCount }}
                </p>
              </div>
            </div>
            <div class="mask is-squircle flex size-10 items-center justify-center bg-warning/10">
              <i class="fa-solid fa-user text-xl text-warning"></i>
            </div>
            <div class="absolute bottom-0 right-0 overflow-hidden rounded-lg">
              <i class="fa-solid fa-user translate-x-1/4 translate-y-1/4 text-5xl opacity-15"></i>
            </div>
          </div>
          <div class="card flex-row justify-between p-4">
            <div>
              <p class="text-xs+ uppercase">Domains</p>
              <div class="mt-8 flex items-baseline space-x-1">
                <p class="text-2xl font-semibold text-slate-700 dark:text-navy-100">
                  {{ $domainsCount  }}
                </p>
              </div>
            </div>
            <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
              <i class="fa-solid fa-globe text-xl text-info"></i>
            </div>
            <div class="absolute bottom-0 right-0 overflow-hidden rounded-lg">
              <i class="fa-solid fa-globe translate-x-1/4 translate-y-1/4 text-5xl opacity-15"></i>
            </div>
          </div>
          <div class="card flex-row justify-between p-4">
            <div>
              <p class="text-xs+ uppercase">Feedbacks</p>
              <div class="mt-8 flex items-baseline space-x-1">
                <p class="text-2xl font-semibold text-slate-700 dark:text-navy-100">
                  {{ $feedbackCount }}
                </p>
              </div>
            </div>
            <div class="mask is-squircle flex size-10 items-center justify-center bg-success/10">
              <i class="fa-solid fa-comments text-xl text-success"></i>
            </div>
            <div class="absolute bottom-0 right-0 overflow-hidden rounded-lg">
              <i class="fa-solid fa-comments translate-x-1/4 translate-y-1/4 text-5xl opacity-15"></i>
            </div>
          </div>
          <div class="card flex-row justify-between p-4">
            <div>
              <p class="text-xs+ uppercase">Contact Us</p>
              <div class="mt-8 flex items-baseline space-x-1">
                <p class="text-2xl font-semibold text-slate-700 dark:text-navy-100">
                {{ $contactusCount }}
                </p>
              </div>
            </div>
            <div class="mask is-squircle flex size-10 items-center justify-center bg-error/10">
              <i class="fa-solid fa-phone text-xl text-error"></i>
            </div>
            <div class="absolute bottom-0 right-0 overflow-hidden rounded-lg">
              <i class="fa-solid fa-phone translate-x-1/4 translate-y-1/4 text-5xl opacity-15"></i>
            </div>
          </div>


        </div>

            {{-- Cards With Line Loading --}}
        {{-- <div class="grid grid-cols-1 gap-4 px-4 sm:gap-5 sm:px-5 lg:grid-cols-2">


          <div class="rounded-lg border border-slate-150 p-4 dark:border-navy-600">
            <div class="flex justify-between">
              <div>
                <span class="text-2xl font-medium text-slate-700 dark:text-navy-100"></span>
                <span class="text-xs"></span>
              </div>
              <p class="text-xs+">Products</p>
            </div>

            <div class="progress mt-3 h-1.5 bg-slate-150 dark:bg-navy-500">
              <div class="is-active relative w-8/12 overflow-hidden rounded-full bg-success"></div>
            </div>
            <div class="mt-2 flex justify-between text-xs text-slate-400 dark:text-navy-300">
              <p>Monthly target</p>
              <p>50%</p>
            </div>
          </div>



          <div class="rounded-lg border border-slate-150 p-4 dark:border-navy-600">
            <div class="flex justify-between">
              <div>
                <span class="text-2xl font-medium text-slate-700 dark:text-navy-100"></span>
                <span class="text-xs"></span>
              </div>
              <p class="text-xs+">Services</p>
            </div>

            <div class="progress mt-3 h-1.5 bg-slate-150 dark:bg-navy-500">
              <div class="relative w-8/12 overflow-hidden rounded-full bg-warning"></div>
            </div>
            <div class="mt-2 flex justify-between text-xs text-slate-400 dark:text-navy-300">
              <p>Monthly target</p>
              <p>70%</p>
            </div>
          </div>



          <div class="rounded-lg border border-slate-150 p-4 dark:border-navy-600">
            <div class="flex justify-between">
              <div>
                <span class="text-2xl font-medium text-slate-700 dark:text-navy-100"></span>
                <span class="text-xs"></span>
              </div>
              <p class="text-xs+">Solutions</p>
            </div>

            <div class="progress mt-3 h-1.5 bg-slate-150 dark:bg-navy-500">
              <div class="relative w-5/12 overflow-hidden rounded-full bg-secondary"></div>
            </div>
            <div class="mt-2 flex justify-between text-xs text-slate-400 dark:text-navy-300">
              <p>Monthly target</p>
              <p>65%</p>
            </div>
          </div>




          <div class="rounded-lg border border-slate-150 p-4 dark:border-navy-600">
            <div class="flex justify-between">
              <div>
                <span class="text-2xl font-medium text-slate-700 dark:text-navy-100"></span>
                <span class="text-xs"></span>
              </div>
              <p class="text-xs+">Contact Us</p>
            </div>

            <div class="progress mt-3 h-1.5 bg-slate-150 dark:bg-navy-500">
              <div class="is-active relative w-4/12 overflow-hidden rounded-full bg-slate-500 dark:bg-navy-400"></div>
            </div>
            <div class="mt-2 flex justify-between text-xs text-slate-400 dark:text-navy-300">
              <p>Monthly target</p>
              <p>30%</p>
            </div>
          </div>



          <div class="rounded-lg border border-slate-150 p-4 dark:border-navy-600">
            <div class="flex justify-between">
              <div>
                <span class="text-xs"></span>
              </div>
              <p class="text-xs+">Subscribes</p>
            </div>

            <div class="progress mt-3 h-1.5 bg-slate-150 dark:bg-navy-500">
              <div class="is-active relative w-4/12 overflow-hidden rounded-full bg-slate-500 dark:bg-navy-400"></div>
            </div>
            <div class="mt-2 flex justify-between text-xs text-slate-400 dark:text-navy-300">
              <p>Monthly target</p>
              <p>35%</p>
            </div>
          </div>
        </div> --}}


        <br>
        <br>
        <div id="chart"></div>
      </div>
    </div>

  </main>

  {{-- Apex Charts Script --}} 
  <script>
    document.addEventListener("DOMContentLoaded", function() {
            // Calculate max user count to set Y-axis
            var userCounts = {!! json_encode($userCounts) !!};
            var maxCount = Math.max(...userCounts);
            var yAxisMax;

            // Determine Y-axis max value based on user count
            if (maxCount > 10) {
                yAxisMax = Math.ceil(maxCount / 10) * 10; // Round up to the nearest 10
            } else {
                yAxisMax = 10; // Default max value if less than or equal to 10
            }

            var options = {
                chart: {
                    type: 'area',
                    height: 350,
                    zoom: {
                        enabled: false
                    },
                },
                series: [{
                    name: 'User Count',
                    data: userCounts // User counts data
                }],
                xaxis: {
                    categories: {!! json_encode($months) !!}, // Month labels
                },
                yaxis: {
                    max: yAxisMax, // Set calculated max for Y-axis
                    tickAmount: yAxisMax > 10 ? 5 : 10, // Adjust tick amounts
                    labels: {
                        formatter: function(value) {
                            return Math.floor(value); // Ensure whole numbers
                        }
                    }
                },
                title: {
             text: 'User Count Over the Last 12 Months',
            align: 'left'
    },
                tooltip: {
                    shared: true,
                    intersect: false
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
</script>

  @endsection

@push('scripts')

@endpush

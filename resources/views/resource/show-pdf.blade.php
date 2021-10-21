<x-app-layout>
    <div class="md:h-[90.3vh] h-screen xl:h-screen" id="adobe-dc-view"></div>
    <script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
    <script type="text/javascript">
        document.addEventListener("adobe_dc_view_sdk.ready", function() {
            var adobeDCView = new AdobeDC.View({
                clientId: "{{ env('ADOBE_CLIENT_ID') }}"
                , divId: "adobe-dc-view"
            });
            adobeDCView.previewFile({
                content: {
                    location: {
                        url: "{{ $resource->resourceful->full_url }}"
                    }
                }
                , metaData: {
                    fileName: "{{ $resource->title }}"
                }
            }, {}).then(adobeViewer => {
                adobeViewer.getAPIs().then(apis => {
                    apis.gotoLocation({{ request()->input('page') }})
                        .then(() => console.log("Success"))
                        .catch(error => console.log(error));
         });
        });
        });

    </script>
</x-app-layout>

<?php

namespace App\Controller;

use App\Entity\Coffeeshop;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadImageActionController extends AbstractController
{
    /**
     * @Route("/api/coffeeshop/{id}/images", methods={"POST"}, name="upload_image_action")
     * @ParamConverter("coffeeshop", class="App\Entity\Coffeeshop")
     */
    public function uploadImageAction(Coffeeshop $coffeeshop, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('image');
        if (!$this->isValidFormat($uploadedFile)) {
            return new JsonResponse([], Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
        } else {
            $projectDir = $this->getParameter('kernel.project_dir');
            if (!is_string($projectDir)) {
                return new JsonResponse([], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            $destination = $projectDir.'/public/uploads';
            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
            $uploadedFile
                ->move(
                    $destination,
                    $newFilename
                );

            $coffeeshop->setImage('/uploads/'.$newFilename);

            $entityManager->persist($coffeeshop);
            $entityManager->flush();

            $response = new JsonResponse(
                [
                    'coffeeshop_id' => $coffeeshop->getId(),
                    'path' => $coffeeshop->getImage(),
                ]
            );
        }

        return $response;
    }

    private function isValidFormat(File $imageFile): bool
    {
        $allowedFormats = [
            'image/png',
            'image/jpeg',
            'image/jpg',
        ];

        return in_array($imageFile->getMimeType(), $allowedFormats, true);
    }
}
